<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleansy Laundry - Kasir</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 10px; }
        
        input[type="date"]::-webkit-calendar-picker-indicator,
        input[type="time"]::-webkit-calendar-picker-indicator { filter: invert(1); cursor: pointer; }

        @media print {
            body * { visibility: hidden !important; }
            #print-section, #print-section * { visibility: visible !important; }
            #print-section { position: absolute; left: 0; top: 0; width: 100%; display: block !important; }
            @page { margin: 0; } 
        }
    </style>
</head>
<body class="bg-[#12141c] text-white font-sans h-screen flex overflow-hidden relative">

    <div id="print-section" class="hidden">
        <div style="width: 58mm; padding: 10px; font-family: 'Courier New', Courier, monospace; font-size: 12px; color: black; line-height: 1.5;">
            <div style="text-align: center; margin-bottom: 10px;">
                <h2 style="font-size: 16px; font-weight: bold; margin: 0;">CLEANSY LAUNDRY</h2>
                <p style="margin: 0; font-size: 10px;">Jl. Manggis No. 51, Nologaten</p>
            </div>
            
            <div style="border-top: 1px dashed black; border-bottom: 1px dashed black; padding: 5px 0; margin-bottom: 5px;">
                <p style="margin: 0; display: flex; justify-content: space-between;"><span>Tgl: <span id="print-tgl"></span></span> <span>Kasir</span></p>
                <p style="margin: 0;">Nota: <span id="print-nota"></span></p>
                <p style="margin: 0;">Plg : <span id="print-nama"></span></p>
            </div>
            
            <div style="margin-bottom: 5px;">
                <p style="margin: 0; display: flex; justify-content: space-between;">
                    <span>Laundry (<span id="print-berat"></span> Kg)</span>
                    <span id="print-total"></span>
                </p>
            </div>
            
            <div style="border-top: 1px dashed black; padding-top: 5px; margin-bottom: 10px;">
                <p style="margin: 0; display: flex; justify-content: space-between; font-weight: bold; font-size: 14px;"><span>Total</span> <span id="print-total-akhir"></span></p>
                <p style="margin: 0; display: flex; justify-content: space-between;"><span>Bayar</span> <span id="print-tunai"></span></p>
                <p style="margin: 0; display: flex; justify-content: space-between;"><span>Kembali</span> <span id="print-kembalian"></span></p>
            </div>
            
            <div style="text-align: center; font-size: 10px;">
                <p style="margin: 0;">*** LUNAS ***</p>
                <p style="margin: 0; margin-top: 5px;">Terima Kasih</p>
            </div>
        </div>
    </div>

    <aside class="w-16 md:w-20 bg-[#161922] border-r border-gray-800 flex flex-col items-center py-6 gap-8 flex-shrink-0 z-10">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1 shadow-[0_0_15px_rgba(64,196,170,0.3)] mb-4">
            <span class="text-xs font-bold text-teal-600">CL</span>
        </div>
        
        <div title="Kasir & POS" class="w-10 h-10 bg-[#1b4340] border border-[#4bd3b6]/50 rounded-xl flex items-center justify-center text-[#4bd3b6] shadow-[0_0_10px_rgba(75,211,182,0.2)]">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </div>

        <a href="{{ route('kasir.riwayat') }}" title="Riwayat Transaksi" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white cursor-pointer transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </a>

        <a href="{{ route('kasir.laporan') }}" title="Laporan Kas" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white cursor-pointer transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </a>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#1a1d26]">
        
        <header class="h-16 flex justify-between items-center px-6 border-b border-gray-800 flex-shrink-0">
            <h1 class="text-[#4bd3b6] text-xl font-bold tracking-wide">Cleansy Laundry</h1>
            <div class="flex items-center gap-6 text-sm text-gray-400 font-mono">
                <span id="realtime-clock"></span>
                <span class="flex items-center gap-2 text-white font-sans text-xs bg-gray-800 px-3 py-1 rounded-full border border-gray-700">
                    <span class="w-1.5 h-1.5 bg-[#4bd3b6] rounded-full"></span>
                    {{ strtoupper(auth()->user()->name ?? 'KASIR') }}
                </span>
                
                @if(isset($shiftAktif) && $shiftAktif)
                    <button type="button" onclick="alert('⚠️ Selesaikan shift Anda di menu Laporan Kas terlebih dahulu!')" class="text-gray-600 cursor-not-allowed flex items-center gap-1 font-bold">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Logout Terkunci
                    </button>
                @else
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-white transition flex items-center gap-1">Logout</button>
                    </form>
                @endif
            </div>
        </header>

        <div class="flex-1 overflow-y-auto p-6 lg:p-8">
            @if(session('success'))
                <div class="mb-4 bg-[#1b4340] border border-[#4bd3b6]/50 text-[#4bd3b6] px-4 py-3 rounded text-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="mb-4 bg-red-900/50 border border-red-500/50 text-red-400 px-4 py-3 rounded text-sm">{{ session('error') }}</div>
            @endif
            @if($errors->any())
                <div class="mb-4 bg-red-900/50 border border-red-500/50 text-red-400 px-4 py-3 rounded text-sm">{{ $errors->first() }}</div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 h-full">
                
                <div class="lg:col-span-4 flex flex-col h-full">
                    <h2 class="text-white text-lg font-semibold flex items-center gap-2 mb-4">🛒 Input Pesanan Baru</h2>

                    @if(isset($shiftAktif) && $shiftAktif)
                        <form id="form-pesanan" action="{{ route('kasir.order.store') }}" method="POST" class="flex flex-col gap-4">
                            @csrf
                            <div class="grid grid-cols-2 gap-3">
                                <input type="text" name="nama" id="input_nama" placeholder="Nama Pelanggan" class="bg-[#12141c] border border-gray-700 text-white text-sm rounded-lg p-2.5 outline-none focus:border-[#4bd3b6]" required>
                                <input type="text" name="no_wa" placeholder="No WhatsApp" class="bg-[#12141c] border border-gray-700 text-white text-sm rounded-lg p-2.5 outline-none focus:border-[#4bd3b6]">
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="tipe_pelanggan" value="Umum" class="peer sr-only" checked>
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 text-xs font-bold text-center py-2 rounded-lg peer-checked:bg-[#4bd3b6] peer-checked:text-[#12141c] transition">Umum</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="tipe_pelanggan" value="Anak Pondok" class="peer sr-only">
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 text-xs font-bold text-center py-2 rounded-lg peer-checked:bg-[#4bd3b6] peer-checked:text-[#12141c] transition">Anak Pondok</div>
                                </label>
                            </div>

                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_layanan" value="Express" class="peer sr-only" onchange="hitungTotal(); updateWaktuLayanan();">
                                    <div class="bg-[#12141c] border border-gray-700 text-red-500 font-bold text-center py-2.5 rounded-lg peer-checked:bg-[#c00f27] peer-checked:text-white transition">EXPRESS</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="jenis_layanan" value="Reguler" class="peer sr-only" onchange="hitungTotal(); updateWaktuLayanan();" checked>
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 font-bold text-center py-2.5 rounded-lg peer-checked:bg-gray-700 peer-checked:text-white transition">REGULER</div>
                                </label>
                            </div>

                            <div class="grid grid-cols-3 gap-2">
                                <label class="cursor-pointer">
                                    <input type="radio" name="sub_layanan" value="Cuci Komplit" class="peer sr-only" checked>
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 text-[10px] font-bold text-center py-2 rounded-lg peer-checked:bg-gray-700 peer-checked:text-white transition">Cuci Komplit</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="sub_layanan" value="Cuci Saja" class="peer sr-only">
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 text-[10px] font-bold text-center py-2 rounded-lg peer-checked:bg-gray-700 peer-checked:text-white transition">Cuci Saja</div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="sub_layanan" value="Setrika Saja" class="peer sr-only">
                                    <div class="bg-[#12141c] border border-gray-700 text-gray-400 text-[10px] font-bold text-center py-2 rounded-lg peer-checked:bg-gray-700 peer-checked:text-white transition">Setrika Saja</div>
                                </label>
                            </div>

                            <div class="grid grid-cols-2 gap-3 mt-1">
                                <select name="item_khusus" class="bg-[#12141c] border border-gray-700 text-white text-xs rounded-lg p-2.5 outline-none focus:border-[#4bd3b6]">
                                    <option value="">Item Khusus (Pilih)</option>
                                    <option value="Sprei">Sprei</option>
                                    <option value="Selimut">Selimut</option>
                                    <option value="Bed Cover">Bed Cover</option>
                                </select>
                                <div class="relative">
                                    <input type="number" step="0.1" name="berat" id="input_berat" oninput="hitungTotal()" placeholder="0.0" class="bg-[#12141c] border border-gray-700 text-white text-sm rounded-lg block w-full p-2.5 pr-8 outline-none focus:border-[#4bd3b6]" required>
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 text-xs font-bold">Kg</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-3 mt-2">
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase">Tanggal Masuk</label>
                                    <input type="date" name="tgl_masuk" id="tgl_masuk" class="bg-[#12141c] border border-gray-700 text-white text-xs rounded-md w-full p-2 mt-1 [color-scheme:dark]">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase">Tanggal Selesai</label>
                                    <input type="date" name="tgl_selesai" id="tgl_selesai" class="bg-[#12141c] border border-gray-700 text-white text-xs rounded-md w-full p-2 mt-1 [color-scheme:dark]">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase">Jam Masuk</label>
                                    <input type="time" name="jam_masuk" id="jam_masuk" class="bg-[#12141c] border border-gray-700 text-white text-xs rounded-md w-full p-2 mt-1 [color-scheme:dark]">
                                </div>
                                <div>
                                    <label class="text-[10px] font-bold text-gray-500 uppercase">Jam Selesai</label>
                                    <input type="time" name="jam_selesai" id="jam_selesai" class="bg-[#12141c] border border-gray-700 text-white text-xs rounded-md w-full p-2 mt-1 [color-scheme:dark]">
                                </div>
                            </div>

                            <div class="mt-2">
                                <label class="text-[10px] font-bold text-gray-500 uppercase">Total (Rp)</label>
                                <input type="text" id="display_total" class="bg-[#12141c] border border-gray-700 text-[#4bd3b6] text-xl font-bold rounded-lg w-full p-3 mt-1" value="0" readonly>

                                <div class="flex bg-[#12141c] rounded-full p-1 border border-gray-700 mt-4">
                                    <label class="w-1/2 cursor-pointer relative">
                                        <input type="radio" name="metode_pembayaran" value="Cash" class="peer sr-only" checked>
                                        <div class="text-center text-xs font-bold text-gray-500 py-2 rounded-full peer-checked:bg-[#1b4340] peer-checked:text-[#4bd3b6] transition">Cash</div>
                                    </label>
                                    <label class="w-1/2 cursor-pointer relative">
                                        <input type="radio" name="metode_pembayaran" value="QR Code" class="peer sr-only">
                                        <div class="text-center text-xs font-bold text-gray-500 py-2 rounded-full peer-checked:bg-[#1b4340] peer-checked:text-[#4bd3b6] transition">QR Code</div>
                                    </label>
                                </div>
                            </div>

                            <button type="button" onclick="prosesSubmit()" class="mt-4 bg-[#4bd3b6] text-[#12141c] font-bold py-3.5 rounded-lg">SUBMIT</button>
                        </form>
                    @else
                        <div class="bg-[#161922] border border-gray-800 rounded-2xl flex flex-col items-center justify-center p-10 text-center h-full shadow-lg">
                            <h2 class="text-2xl font-bold text-white mb-2">Shift Belum Dimulai</h2>
                            <p class="text-gray-400 text-sm mb-8 leading-relaxed">Sistem pencatatan order terkunci. Silakan mulai shift kerja Anda untuk membuka akses input pesanan baru.</p>
                            <form action="{{ route('kasir.shift.start') }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full bg-[#4bd3b6] hover:bg-[#3db097] text-[#12141c] font-bold py-4 rounded-xl shadow-[0_0_15px_rgba(75,211,182,0.3)] transition">Mulai Shift Sekarang</button>
                            </form>
                        </div>
                    @endif
                </div>

                <div class="lg:col-span-8 flex flex-col h-full">
                    <h2 class="text-white text-lg font-semibold flex items-center gap-2 mb-4">📊 Antrean Visual Aktif</h2>
                    <div class="bg-[#161922] border border-gray-800 rounded-xl overflow-hidden flex-1 flex flex-col">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left text-sm whitespace-nowrap">
                                <thead class="text-gray-400 font-bold text-xs uppercase bg-[#12141c] border-b border-gray-800">
                                    <tr>
                                        <th class="px-6 py-4">PESAN</th>
                                        <th class="px-6 py-4">PELANGGAN</th>
                                        <th class="px-6 py-4">PRIORITAS</th>
                                        <th class="px-6 py-4">STATUS</th>
                                        <th class="px-6 py-4">DEADLINE</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-800/50">
                                    @forelse($antrean as $pesanan)
                                        <tr class="hover:bg-gray-800/30 transition">
                                            <td class="px-6 py-4 text-[#4bd3b6] font-mono text-xs">{{ $pesanan->kode_pesanan }}</td>
                                            
                                            <td class="px-6 py-4">
                                                <div class="font-bold text-white">{{ $pesanan->customer->nama }}</div>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[10px] text-gray-400 font-mono">{{ $pesanan->customer->no_wa ?? 'Tidak ada WA' }}</span>
                                                    <span class="text-[9px] text-gray-400 uppercase tracking-wider font-bold bg-[#12141c] border border-gray-700 px-1.5 py-0.5 rounded">{{ $pesanan->customer->tipe_pelanggan }}</span>
                                                </div>
                                            </td>

                                            <td class="px-6 py-4">
                                                @if($pesanan->jenis_layanan == 'Express')
                                                    <span class="bg-[#c00f27] text-white text-[10px] font-bold px-2 py-1 rounded">EXPRESS</span>
                                                @else
                                                    <span class="bg-[#1b4340] text-[#4bd3b6] text-[10px] font-bold px-2 py-1 rounded border border-[#4bd3b6]/30">REGULER</span>
                                                @endif
                                            </td>

                                            <td class="px-6 py-4">
                                                <div class="text-gray-300 text-xs">[{{ $pesanan->status_cucian }}] Aktif ></div>
                                                <div class="text-[#4bd3b6] text-[10px] font-bold mt-1">{{ $pesanan->item_khusus }}</div>
                                            </td>
                                            
                                            <td class="px-6 py-4 text-gray-400 font-mono text-xs">{{ \Carbon\Carbon::parse($pesanan->tenggat_waktu)->format('d M H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5" class="px-6 py-8 text-center text-gray-500 italic">Belum ada antrean.</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div id="modal-cash" class="hidden fixed inset-0 bg-[#12141c]/90 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-3xl overflow-hidden shadow-2xl relative">
            <div class="p-6 border-b flex justify-between bg-gray-50">
                <h3 class="text-xl font-bold text-gray-900">Konfirmasi Pembayaran</h3>
                <button onclick="tutupModal()" class="text-2xl font-bold text-gray-400">&times;</button>
            </div>
            <div class="p-8 grid grid-cols-2 gap-8">
                <div class="flex flex-col gap-4">
                    <div class="bg-[#12141c] text-white p-5 rounded-2xl">
                        <p class="text-[10px] text-gray-400 font-bold mb-1">Total Tagihan</p>
                        <p class="text-4xl font-extrabold flex items-center gap-2">Rp <span id="modal-cash-total">0</span></p>
                    </div>
                    <div class="border-2 border-[#4bd3b6] rounded-2xl p-4 mt-2">
                        <p class="text-xs text-gray-500 font-bold">Jumlah Uang Fisik</p>
                        <div class="flex items-center text-3xl font-bold text-gray-900">
                            Rp <input type="number" id="input_uang_fisik" oninput="hitungKembalian()" class="ml-2 w-full outline-none" placeholder="0">
                        </div>
                    </div>
                    <div class="bg-[#12141c] p-4 rounded-2xl text-white mt-2 flex justify-between">
                        <span class="text-sm text-gray-400">Kembalian:</span>
                        <span class="text-xl font-bold text-[#4bd3b6]">Rp <span id="modal-kembalian">0</span></span>
                    </div>
                </div>
                
                <div class="bg-[#1a1d26] rounded-2xl p-6 text-white text-center flex flex-col justify-center">
                    <div class="grid grid-cols-3 gap-2 w-full mb-4">
                        <button type="button" onclick="setUang(20000)" class="bg-white text-gray-900 font-bold py-2 rounded-lg text-sm">20k</button>
                        <button type="button" onclick="setUang(50000)" class="bg-white text-gray-900 font-bold py-2 rounded-lg text-sm">50k</button>
                        <button type="button" onclick="setUang(100000)" class="bg-white text-gray-900 font-bold py-2 rounded-lg text-sm">100k</button>
                    </div>

                    <div class="grid grid-cols-3 gap-2 w-full text-xl">
                        <button type="button" onclick="ketikAngka('7')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">7</button>
                        <button type="button" onclick="ketikAngka('8')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">8</button>
                        <button type="button" onclick="ketikAngka('9')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">9</button>
                        <button type="button" onclick="ketikAngka('4')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">4</button>
                        <button type="button" onclick="ketikAngka('5')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">5</button>
                        <button type="button" onclick="ketikAngka('6')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">6</button>
                        <button type="button" onclick="ketikAngka('1')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">1</button>
                        <button type="button" onclick="ketikAngka('2')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">2</button>
                        <button type="button" onclick="ketikAngka('3')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">3</button>
                        <button type="button" onclick="ketikAngka('0')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">0</button>
                        <button type="button" onclick="ketikAngka('00')" class="bg-white text-gray-900 font-bold py-3.5 rounded-lg">00</button>
                        <button type="button" onclick="hapusAngka()" class="bg-[#3e1f1f] text-[#ff7979] font-bold py-3.5 rounded-lg flex justify-center items-center">Hapus</button>
                    </div>
                    <button type="button" onclick="setUangPas()" class="w-full bg-[#374151] hover:bg-gray-600 text-white font-bold py-3 rounded-lg mt-3 text-sm">Uang Pas</button>
                </div>
            </div>
            <div class="bg-gray-100 p-6 flex gap-4">
                <button onclick="tutupModal()" class="w-1/3 bg-gray-300 font-bold py-4 rounded-xl">Batal</button>
                <button onclick="eksekusiForm()" class="w-2/3 bg-[#4bd3b6] text-white font-bold py-4 rounded-xl">Cetak Nota Tunai</button>
            </div>
        </div>
    </div>

    <!-- MODAL QRIS -->
    <div id="modal-qris" class="hidden fixed inset-0 bg-[#12141c]/90 z-50 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white rounded-[2rem] w-full max-w-sm overflow-hidden shadow-2xl flex flex-col">
            <!-- Header Modal Dark -->
            <div class="bg-[#12141c] text-white px-6 py-5 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-[#4bd3b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm14 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                    <span class="font-bold text-sm">Pembayaran QRIS</span>
                </div>
                <button onclick="tutupModal()" class="text-gray-400 hover:text-white text-xl transition">&times;</button>
            </div>
            
            <!-- Body Modal -->
            <div class="p-8 text-center bg-[#f4f7f9] flex flex-col items-center">
                <p class="text-sm font-bold text-slate-500 mb-1">Total Tagihan Nota</p>
                <!-- Angka dan Rp disatukan tanpa spasi sesuai desain -->
                <h3 class="text-4xl font-black text-[#0f172a] mb-8">Rp<span id="modal-qris-total">0</span></h3>
                
                <!-- Kotak QRIS dengan Shadow Cyan -->
                <div class="bg-white p-5 rounded-3xl shadow-[0_0_40px_rgba(75,211,182,0.25)] mb-8 inline-block border border-gray-100">
                    <!-- Memakai dummy image API agar terlihat seperti QR asli -->
                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=Pembayaran-QRIS-Cleansy" alt="QRIS" class="w-48 h-48 mb-4 rounded-lg mx-auto">
                    <div class="bg-slate-100 rounded-full px-4 py-1.5 flex items-center justify-center gap-2 w-max mx-auto">
                        <div class="w-8 h-3 bg-slate-300 rounded-sm"></div>
                        <span class="text-[10px] font-bold text-slate-500 tracking-wider">QRIS</span>
                    </div>
                </div>
                
                <p class="text-[13px] font-medium text-slate-500 mb-8 leading-relaxed">
                    Silakan tunjukkan layar ini kepada<br>pelanggan untuk dipindai
                </p>
                
                <!-- Tombol Action -->
                <div class="flex gap-4 w-full mb-6">
                    <button onclick="tutupModal()" class="flex-1 bg-white border border-slate-200 text-slate-700 font-bold py-3.5 rounded-2xl hover:bg-slate-50 transition shadow-sm">
                        Batal
                    </button>
                    <!-- Tombol ini memicu fungsi cetak nota dan submit data -->
                    <button onclick="eksekusiForm()" class="flex-1 bg-[#20b2aa] hover:bg-[#1c9c95] text-white font-bold py-3.5 px-2 rounded-2xl flex items-center justify-center gap-2 transition shadow-lg shadow-teal-500/30 text-sm">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Cek Status<br>Pembayaran
                    </button>
                </div>
                
                <p class="text-[11px] font-medium text-slate-400">
                    Sistem akan otomatis memperbarui status pesanan
                </p>
            </div>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const optionsDate = { day: 'numeric', month: 'short', year: 'numeric' };
            document.getElementById('realtime-clock').textContent = `${now.toLocaleDateString('id-ID', optionsDate)} || ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
        }
        setInterval(updateClock, 1000); updateClock();

        const hargaReguler = 5000; const hargaExpress = 8000; let totalTagihanAngka = 0;

        function formatUntukDateInput(dateObj) {
            const y = dateObj.getFullYear();
            const m = String(dateObj.getMonth() + 1).padStart(2, '0');
            const d = String(dateObj.getDate()).padStart(2, '0');
            return `${y}-${m}-${d}`;
        }

        function formatUntukTimeInput(dateObj) {
            const h = String(dateObj.getHours()).padStart(2, '0');
            const min = String(dateObj.getMinutes()).padStart(2, '0');
            return `${h}:${min}`;
        }

        function updateWaktuLayanan() {
            const isExpress = document.querySelector('input[name="jenis_layanan"][value="Express"]').checked;
            const dateMasuk = new Date();
            const dateSelesai = new Date();
            
            if (isExpress) dateSelesai.setDate(dateSelesai.getDate() + 1); 
            else dateSelesai.setDate(dateSelesai.getDate() + 3); 

            document.getElementById('tgl_masuk').value = formatUntukDateInput(dateMasuk);
            document.getElementById('tgl_selesai').value = formatUntukDateInput(dateSelesai);
            document.getElementById('jam_masuk').value = formatUntukTimeInput(dateMasuk);
            document.getElementById('jam_selesai').value = formatUntukTimeInput(dateSelesai);
        }

        function hitungTotal() {
            const berat = parseFloat(document.getElementById('input_berat').value) || 0;
            const isExpress = document.querySelector('input[name="jenis_layanan"][value="Express"]').checked;
            totalTagihanAngka = berat * (isExpress ? hargaExpress : hargaReguler);
            
            const formatRp = new Intl.NumberFormat('id-ID').format(totalTagihanAngka);
            document.getElementById('display_total').value = formatRp;
            document.getElementById('modal-cash-total').textContent = formatRp;
            document.getElementById('modal-qris-total').textContent = formatRp;
        }

        const inputUangFisik = document.getElementById('input_uang_fisik');
        function ketikAngka(angka) { inputUangFisik.value += angka; hitungKembalian(); }
        function hapusAngka() { inputUangFisik.value = inputUangFisik.value.slice(0, -1); hitungKembalian(); }
        function setUang(nominal) { inputUangFisik.value = nominal; hitungKembalian(); }
        function setUangPas() { inputUangFisik.value = totalTagihanAngka; hitungKembalian(); }

        function hitungKembalian() {
            const kembalian = (parseFloat(inputUangFisik.value) || 0) - totalTagihanAngka;
            const display = document.getElementById('modal-kembalian');
            if (kembalian < 0) {
                display.textContent = "Kurang " + new Intl.NumberFormat('id-ID').format(Math.abs(kembalian));
                display.classList.replace('text-[#4bd3b6]', 'text-red-500');
            } else {
                display.textContent = new Intl.NumberFormat('id-ID').format(kembalian);
                display.classList.replace('text-red-500', 'text-[#4bd3b6]');
            }
        }

        function prosesSubmit() {
            const nama = document.getElementById('input_nama').value;
            const berat = document.getElementById('input_berat').value;
            if(!nama || !berat || berat <= 0) { alert("Isi Nama Pelanggan dan Berat!"); return; }

            const metode = document.querySelector('input[name="metode_pembayaran"]:checked').value;
            if (metode === 'Cash') {
                document.getElementById('modal-cash').classList.remove('hidden');
                inputUangFisik.value = ''; hitungKembalian();
            } else { document.getElementById('modal-qris').classList.remove('hidden'); }
        }

        function tutupModal() { 
            document.getElementById('modal-cash').classList.add('hidden'); 
            document.getElementById('modal-qris').classList.add('hidden'); 
        }

        function eksekusiForm() {
            const metode = document.querySelector('input[name="metode_pembayaran"]:checked').value;
            
            if (metode === 'Cash') {
                const uangFisik = parseFloat(inputUangFisik.value) || 0;
                const selisihKurang = totalTagihanAngka - uangFisik;

                if (selisihKurang > 0) {
                    if (selisihKurang <= 1000) {
                        console.log("Toleransi Kasir Aktif: Sistem menanggung minus Rp" + selisihKurang);
                    } else {
                        alert("⚠️ TRANSAKSI DITOLAK!\nUang pelanggan kurang Rp" + new Intl.NumberFormat('id-ID').format(selisihKurang) + ".\nBatas toleransi kurang bayar maksimal hanya Rp1.000.");
                        return; 
                    }
                }
            }

            document.getElementById('print-nama').textContent = document.getElementById('input_nama').value || 'Umum';
            document.getElementById('print-berat').textContent = document.getElementById('input_berat').value;
            document.getElementById('print-tgl').textContent = document.getElementById('tgl_masuk').value;
            document.getElementById('print-nota').textContent = '#ORD-' + Math.floor(1000 + Math.random() * 9000);
            
            const total = document.getElementById('display_total').value;
            document.getElementById('print-total').textContent = total;
            document.getElementById('print-total-akhir').textContent = total;
            
            if (metode === 'Cash') {
                document.getElementById('print-tunai').textContent = new Intl.NumberFormat('id-ID').format(inputUangFisik.value || 0);
                const kembalian = (parseFloat(inputUangFisik.value) || 0) - totalTagihanAngka;
                if (kembalian < 0) {
                    document.getElementById('print-kembalian').textContent = "Toleransi (-" + Math.abs(kembalian) + ")";
                } else {
                    document.getElementById('print-kembalian').textContent = new Intl.NumberFormat('id-ID').format(kembalian);
                }
            } else {
                document.getElementById('print-tunai').textContent = "QRIS";
                document.getElementById('print-kembalian').textContent = "0";
            }

            window.print();
            setTimeout(() => { tutupModal(); document.getElementById('form-pesanan').submit(); }, 1500);
        }

        window.onload = function() { 
            if(document.getElementById('input_berat')){ updateWaktuLayanan(); hitungTotal(); }
        };
    </script>
    
</body>
</html>