@extends('layouts.admin')

@section('content')
<header class="h-20 flex justify-between items-center px-10 border-b border-gray-800 flex-shrink-0 bg-[#161922]">
    <div class="text-sm text-gray-400 font-medium">
        Owner > <span class="text-[#4bd3b6]">Log Audit Kasir</span>
        <span class="ml-4 text-[#4bd3b6] font-mono tracking-widest" id="realtime-clock"></span>
    </div>
    
    <div class="flex items-center gap-6">
        <div class="text-right">
            <div class="text-xs text-gray-400 mb-0.5">Sesi: Owner</div>
            <div class="text-sm font-bold text-[#4bd3b6]">{{ strtoupper(auth()->user()->name ?? 'BOS RAFI') }}</div>
        </div>
        <div class="flex items-center gap-4 text-gray-400">
            <div class="relative cursor-pointer hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.02 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0 cursor-pointer hover:text-white transition">
                @csrf
                <button type="submit" class="bg-transparent border-none p-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </button>
            </form>
        </div>
    </div>
</header>

<div class="flex-1 overflow-y-auto p-10 flex flex-col h-full bg-[#161922]">
    
    <!-- HEADER PANEL & FILTER -->
    <div class="bg-[#1a1d26] border border-gray-800 rounded-t-2xl p-6 lg:p-8 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-bold text-white tracking-wide">Riwayat Tutup Shift &<br>Rekonsiliasi Kas</h2>
            <p class="text-gray-400 text-sm mt-2">Monitoring integritas keuangan outlet secara real-time.</p>
        </div>
        
        <form action="{{ route('admin.audit') }}" method="GET" class="flex gap-4">
            <div class="relative">
                <select name="rentang" onchange="this.form.submit()" class="appearance-none bg-[#2a2f3e] border border-gray-700 text-gray-300 px-5 py-3 pr-10 rounded-xl text-xs font-semibold outline-none cursor-pointer">
                    <option value="semua" {{ request('rentang') == 'semua' ? 'selected' : '' }}>Rentang Waktu: Semua</option>
                    <option value="hari_ini" {{ request('rentang') == 'hari_ini' ? 'selected' : '' }}>Rentang Waktu: Hari Ini</option>
                    <option value="minggu_ini" {{ request('rentang') == 'minggu_ini' ? 'selected' : '' }}>Rentang Waktu: Minggu Ini</option>
                </select>
                <svg class="w-3.5 h-3.5 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>

            <div class="relative">
                <select name="temuan" onchange="this.form.submit()" class="appearance-none bg-[#2a2f3e] border border-gray-700 text-gray-300 px-5 py-3 pr-10 rounded-xl text-xs font-semibold outline-none cursor-pointer">
                    <option value="semua" {{ request('temuan') == 'semua' ? 'selected' : '' }}>Semua Temuan Audit</option>
                    <option value="matched" {{ request('temuan') == 'matched' ? 'selected' : '' }}>Status: MATCHED</option>
                    <option value="unmatched" {{ request('temuan') == 'unmatched' ? 'selected' : '' }}>Status: UNMATCHED</option>
                </select>
                <svg class="w-3.5 h-3.5 absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </div>

            <div class="relative flex">
                <select name="export" onchange="if(this.value) { window.location.href='{{ route('admin.audit') }}?export='+this.value; this.value=''; }" class="appearance-none bg-[#4bd3b6] hover:bg-[#3db097] text-[#161922] px-6 py-3 pr-10 rounded-xl text-xs font-bold outline-none cursor-pointer transition">
                    <option value="" disabled selected>Ekspor Laporan</option>
                    <option value="harian">Unduh CSV Hari Ini</option>
                    <option value="mingguan">Unduh CSV Minggu Ini</option>
                </select>
                <div class="absolute right-0 top-0 bottom-0 flex items-center px-3 border-l border-[#3db097] pointer-events-none">
                    <svg class="w-3.5 h-3.5 text-[#161922]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                </div>
            </div>
        </form>
    </div>

    <!-- TABEL DATA -->
    <div class="bg-[#1a1d26] border-x border-gray-800 overflow-x-auto flex-1 relative">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead class="text-gray-400 font-bold text-[10px] uppercase border-y border-gray-800 tracking-wider">
                <tr>
                    <th class="px-8 py-5">TANGGAL & SHIFT</th>
                    <th class="px-6 py-5">NAMA STAF</th>
                    <th class="px-6 py-5">KAS SISTEM</th>
                    <th class="px-6 py-5">FISIK DIINPUT</th>
                    <th class="px-6 py-5">PENDAPATAN QRIS</th>
                    <th class="px-6 py-5">NILAI SELISIH</th>
                    <th class="px-8 py-5 text-center">STATUS LAPORAN</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-800/50">
                @forelse($shifts as $shift)
                    @php
                        // Logika Perhitungan PHP
                        $uangSistemTunai = \App\Models\Order::whereBetween('created_at', [$shift->waktu_mulai, $shift->waktu_selesai])->where('metode_pembayaran', 'Cash')->sum('total_harga');
                        $uangQRIS = \App\Models\Order::whereBetween('created_at', [$shift->waktu_mulai, $shift->waktu_selesai])->where('metode_pembayaran', 'QR Code')->sum('total_harga');
                        
                        // Perbaikan bug "Unknown": Mencari nama user langsung dari database menggunakan user_id
                        $namaStaf = \App\Models\User::find($shift->user_id)->name ?? 'Terhapus/Unknown';
                    @endphp
                    <tr class="hover:bg-gray-800/20 transition">
                        
                        <!-- Perbaikan format tanggal: Tidak lagi bersusun (wrapped), melainkan lurus sebaris menyamping -->
                        <td class="px-8 py-6">
                            <div class="text-white font-semibold text-[13px] mb-1 whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($shift->waktu_mulai)->format('d M Y') }}
                            </div>
                            <div class="flex items-center gap-1.5 text-[11px] text-gray-500 font-mono mt-1 whitespace-nowrap">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Shift {{ $shift->id }}
                            </div>
                        </td>
                        
                        <td class="px-6 py-6 text-gray-300 text-[13px] font-medium">{{ $namaStaf }}</td>
                        <td class="px-6 py-6 font-mono text-gray-400 text-xs">Rp {{ number_format($uangSistemTunai, 0, ',', '.') }}</td>
                        <td class="px-6 py-6 font-mono text-gray-400 text-xs">Rp {{ number_format($shift->uang_fisik, 0, ',', '.') }}</td>
                        <td class="px-6 py-6 font-mono text-gray-400 text-xs">Rp {{ number_format($uangQRIS, 0, ',', '.') }}</td>
                        
                        <td class="px-6 py-6 font-mono font-bold text-xs">
                            @if($shift->selisih == 0) <span class="text-[#4bd3b6]">Rp0</span>
                            @elseif($shift->selisih > 0) <span class="text-blue-400">+Rp {{ number_format($shift->selisih, 0, ',', '.') }}</span>
                            @else <span class="text-red-500">-Rp {{ number_format(abs($shift->selisih), 0, ',', '.') }}</span>
                            @endif
                        </td>
                        
                        <td class="px-8 py-6 text-center">
                            @if($shift->selisih == 0)
                                <span class="border border-[#4bd3b6]/50 bg-transparent text-[#4bd3b6] text-[9px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest">MATCHED</span>
                            @else
                                <span class="border border-[#f17a5d]/50 bg-transparent text-[#f17a5d] text-[9px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest">UNMATCHED</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-20 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-600">
                                <svg class="w-16 h-16 mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                <span class="text-xs">Belum ada data audit kasir.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        
        <!-- Watermark Kotak Kosong -->
        @if(count($shifts) < 3)
            <div class="absolute bottom-10 left-1/2 -translate-x-1/2 opacity-20 pointer-events-none">
                <svg class="w-20 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
            </div>
        @endif
    </div>

    <!-- FOOTER RINGKASAN -->
    <div class="bg-[#242731] border border-gray-800 rounded-b-2xl px-8 py-5 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3 text-gray-400 font-medium text-[11px]">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
            Total Selisih Terakumulasi Bulan {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}: 
            @if($totalSelisih < 0)
                <span class="text-[#f17a5d] font-bold ml-1">-Rp{{ number_format(abs($totalSelisih), 0, ',', '.') }}</span>
            @else
                <span class="text-white font-bold ml-1">Rp{{ number_format($totalSelisih, 0, ',', '.') }}</span>
            @endif
        </div>
        
        <div class="flex items-center gap-2 text-gray-400 font-medium text-[11px]">
            <svg class="w-4 h-4 text-[#4bd3b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Tingkat Akurasi Kas Outlet:
            <span class="text-[#4bd3b6] font-bold text-sm ml-1">{{ $akurasi }}%</span>
        </div>
    </div>
    
</div>

<script>
    setInterval(() => {
        const now = new Date();
        document.getElementById('realtime-clock').textContent = `${now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })} || ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
    }, 1000);
</script>
@endsection