<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Shift;

class KasirDashboardController extends Controller
{
    public function index()
    {
        $shiftAktif = Shift::where('user_id', Auth::id())->where('status', 'aktif')->first();

        $antrean = Order::with('customer')
                        ->whereNotIn('status_cucian', ['Sudah Diambil', 'Tidak Diambil'])
                        ->orderBy('tenggat_waktu', 'asc')
                        ->get();

        return view('kasir.dashboard', compact('antrean', 'shiftAktif'));
    }

    public function startShift()
    {
        Shift::create([
            'user_id' => Auth::id(),
            'status' => 'aktif',
            'waktu_mulai' => now()
        ]);
        return redirect()->back()->with('success', 'Shift kerja berhasil dimulai! Selamat bertugas.');
    }

    public function endShift(Request $request)
    {
        $shiftAktif = Shift::where('user_id', Auth::id())->where('status', 'aktif')->first();
        
        if($shiftAktif) {
            $shiftAktif->update([
                'status' => 'selesai',
                'waktu_selesai' => now(),
                'uang_fisik' => $request->uang_fisik,
                'selisih' => $request->selisih,
            ]);
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function store(Request $request)
    {
        $shiftAktif = Shift::where('user_id', Auth::id())->where('status', 'aktif')->first();
        if (!$shiftAktif) {
            return redirect()->back()->withErrors('Anda harus memulai Shift terlebih dahulu!');
        }

        // --- LOGIKA BARU: VALIDASI KAPASITAS EXPRESS (Maks 10/hari) ---
        if ($request->jenis_layanan === 'Express') {
            $expressCount = Order::whereDate('created_at', today())
                                 ->where('jenis_layanan', 'Express')
                                 ->count();
            
            if ($expressCount >= 10) {
                return redirect()->back()->withErrors('❌ Kapasitas Layanan Express hari ini sudah penuh (Maks 10 pesanan/hari). Silakan pilih layanan Reguler.');
            }
        }
        // -------------------------------------------------------------

        $harga_per_kg = $request->jenis_layanan == 'Express' ? 8000 : 5000;
        $total_harga = $request->berat * $harga_per_kg;
        $deadline = $request->jenis_layanan == 'Express' ? now()->addDay() : now()->addDays(3);
        $kode = '#ORD-' . rand(1000, 9999);

        $customer = \App\Models\Customer::firstOrCreate(
            ['no_wa' => $request->no_wa],
            ['nama' => $request->nama, 'tipe_pelanggan' => $request->tipe_pelanggan ?? 'Umum']
        );

        $statusAwal = ($request->sub_layanan == 'Setrika Saja') ? 'Setrika' : 'Cuci';
        $gabunganItem = $request->sub_layanan . (!empty($request->item_khusus) ? ' + ' . $request->item_khusus : '');

        Order::create([
            'customer_id' => $customer->id,
            'kode_pesanan' => $kode,
            'jenis_layanan' => $request->jenis_layanan,
            'item_khusus' => $gabunganItem, 
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_cucian' => $statusAwal, 
            'tenggat_waktu' => $deadline,
        ]);

        return redirect()->route('kasir.dashboard')->with('success', "Pesanan $kode berhasil ditambahkan!");
    }

    public function riwayat(Request $request)
    {
        $shiftAktif = Shift::where('user_id', Auth::id())->where('status', 'aktif')->first();
        $query = Order::with('customer')->orderBy('created_at', 'desc');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('kode_pesanan', 'like', "%{$search}%")
                  ->orWhereHas('customer', function($qCust) use ($search) {
                      $qCust->where('nama', 'like', "%{$search}%")->orWhere('no_wa', 'like', "%{$search}%");
                  });
            });
        }
        if ($request->filled('status')) {
            $query->where('status_cucian', $request->status);
        }

        $riwayat = $query->paginate(10)->appends($request->query());
        return view('kasir.riwayat', compact('riwayat', 'shiftAktif'));
    }

    public function ambil($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status_cucian' => 'Sudah Diambil']);
        return redirect()->back()->with('success', "Pesanan {$order->kode_pesanan} berhasil diambil!");
    }

    public function laporan()
    {
        $shiftAktif = Shift::where('user_id', Auth::id())->where('status', 'aktif')->first();
        
        if (!$shiftAktif) {
            return redirect()->route('kasir.dashboard')->with('error', 'Silakan mulai shift terlebih dahulu sebelum melihat laporan kas.');
        }

        $transaksi_shift = Order::where('created_at', '>=', $shiftAktif->waktu_mulai)->get();

        $tunai_sistem = $transaksi_shift->where('metode_pembayaran', 'Cash')->sum('total_harga');
        $qris_sistem  = $transaksi_shift->where('metode_pembayaran', 'QR Code')->sum('total_harga');

        return view('kasir.laporan', compact('tunai_sistem', 'qris_sistem', 'shiftAktif'));
    }
}