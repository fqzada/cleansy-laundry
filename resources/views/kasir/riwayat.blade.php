<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi - Cleansy Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#12141c] text-white font-sans h-screen flex overflow-hidden">

    <aside class="w-16 md:w-20 bg-[#161922] border-r border-gray-800 flex flex-col items-center py-6 gap-8 flex-shrink-0">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1 shadow-[0_0_15px_rgba(64,196,170,0.3)] mb-4">
            <span class="text-xs font-bold text-teal-600">CL</span>
        </div>
        
        <a href="{{ route('kasir.dashboard') }}" title="Kasir & POS" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white transition cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </a>
        
        <div title="Riwayat Transaksi" class="w-10 h-10 bg-[#1b4340] border border-[#4bd3b6]/50 rounded-xl flex items-center justify-center text-[#4bd3b6] shadow-[0_0_10px_rgba(75,211,182,0.2)] cursor-default">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </div>
        
        <a href="{{ route('kasir.laporan') }}" title="Laporan Kas" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white transition cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </a>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#1a1d26]">
        
        <header class="h-16 flex justify-between items-center px-6 lg:px-8 border-b border-gray-800 flex-shrink-0">
            
            <div class="flex items-center gap-8 w-2/3">
                <h1 class="text-[#4bd3b6] text-xl font-bold tracking-wide">Cleansy Laundry</h1>
                
                <form action="{{ route('kasir.riwayat') }}" method="GET" class="flex items-center bg-[#12141c] border border-gray-700 rounded-lg px-4 py-2 w-full max-w-md focus-within:border-[#4bd3b6] transition">
                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Kode / Nama / No WA..." class="bg-transparent border-none outline-none text-sm text-white w-full ml-3">
                    @if(request('status'))
                        <input type="hidden" name="status" value="{{ request('status') }}">
                    @endif
                </form>
            </div>

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

        <div class="flex-1 overflow-y-auto p-8">
            
            @if(session('success'))
                <div class="mb-4 bg-[#1b4340] border border-[#4bd3b6]/50 text-[#4bd3b6] px-4 py-3 rounded text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-[#161922] border border-gray-800 rounded-2xl overflow-hidden flex flex-col h-full shadow-lg">
                
                <div class="p-6 border-b border-gray-800 flex justify-between items-start bg-[#161922] relative">
                    <div>
                        <h2 class="text-2xl font-bold text-white tracking-wide">Riwayat Transaksi & Status<br>Pengambilan</h2>
                        <p class="text-gray-500 text-sm mt-1">Daftar pesanan pelanggan Cleansy Laundry</p>
                    </div>
                    
                    <div class="relative">
                        <button onclick="document.getElementById('filterMenu').classList.toggle('hidden')" class="bg-[#2a2f3e] hover:bg-gray-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold flex items-center gap-2 transition border border-gray-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                            Filter {{ request('status') ? '('.request('status').')' : '' }}
                        </button>

                        <div id="filterMenu" class="hidden absolute right-0 mt-2 w-56 bg-[#1a1d26] border border-gray-700 rounded-xl shadow-2xl z-50 p-4">
                            <form action="{{ route('kasir.riwayat') }}" method="GET">
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <label class="text-xs text-gray-400 font-bold mb-2 block uppercase tracking-wider">Status Pencucian</label>
                                <select name="status" class="w-full bg-[#12141c] border border-gray-700 text-white rounded-lg p-2.5 text-sm mb-4 outline-none focus:border-[#4bd3b6]" onchange="this.form.submit()">
                                    <option value="">Semua Status</option>
                                    <option value="Cuci" {{ request('status') == 'Cuci' ? 'selected' : '' }}>Sedang Dicuci</option>
                                    <option value="Setrika" {{ request('status') == 'Setrika' ? 'selected' : '' }}>Sedang Disetrika</option>
                                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Siap Diambil (Selesai)</option>
                                    <option value="Sudah Diambil" {{ request('status') == 'Sudah Diambil' ? 'selected' : '' }}>Sudah Diambil</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead class="text-gray-400 font-bold text-[11px] uppercase bg-[#12141c] border-b border-gray-800 tracking-wider">
                            <tr>
                                <th class="px-6 py-5">KODE BAYAR</th>
                                <th class="px-6 py-5">PELANGGAN & KONTAK</th>
                                <th class="px-6 py-5">DETAIL PESANAN</th>
                                <th class="px-6 py-5">TOTAL BAYAR</th>
                                <th class="px-6 py-5 text-center">KONFIRMASI PENGAMBILAN</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-800/50 bg-[#161922]">
                            @forelse($riwayat as $pesanan)
                                <tr class="hover:bg-gray-800/30 transition">
                                    <td class="px-6 py-4 text-[#4bd3b6] font-mono text-sm font-bold">
                                        {{ $pesanan->kode_pesanan }}
                                        <div class="text-[10px] text-gray-500 font-sans font-normal mt-1">{{ \Carbon\Carbon::parse($pesanan->created_at)->format('d M Y, H:i') }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            @php $inisial = strtoupper(substr($pesanan->customer->nama, 0, 2)); @endphp
                                            <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-[11px] font-bold text-white flex-shrink-0">
                                                {{ $inisial }}
                                            </div>
                                            <div>
                                                <div class="font-bold text-white text-sm">{{ $pesanan->customer->nama }}</div>
                                                <div class="flex items-center gap-2 mt-1">
                                                    <span class="text-[10px] text-gray-400 font-mono">{{ $pesanan->customer->no_wa ?? 'Tidak ada WA' }}</span>
                                                    <span class="text-[9px] text-gray-400 uppercase tracking-wider font-bold bg-[#12141c] border border-gray-700 px-1.5 py-0.5 rounded">{{ $pesanan->customer->tipe_pelanggan }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2 mb-1">
                                            @if($pesanan->jenis_layanan == 'Express')
                                                <span class="bg-[#c00f27] text-white text-[9px] font-bold px-1.5 py-0.5 rounded tracking-wider">EXPRESS</span>
                                            @else
                                                <span class="bg-[#1b4340] text-[#4bd3b6] text-[9px] font-bold px-1.5 py-0.5 rounded tracking-wider border border-[#4bd3b6]/30">REGULER</span>
                                            @endif
                                            <span class="text-xs text-white font-semibold">{{ $pesanan->berat }} Kg</span>
                                        </div>
                                        <div class="text-[10px] text-gray-400 mt-1 font-medium bg-[#12141c] inline-block px-2 py-1 rounded-md border border-gray-800">
                                            {{ $pesanan->item_khusus }}
                                        </div>
                                    </td>
                                    
                                    <td class="px-6 py-4 font-mono text-white font-bold text-sm">
                                        Rp{{ number_format($pesanan->total_harga, 0, ',', '.') }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center">
                                        @if($pesanan->status_cucian == 'Sudah Diambil')
                                            <div class="flex justify-center items-center text-[#4bd3b6]">
                                                <svg class="w-6 h-6 border-2 border-[#4bd3b6] rounded-full p-0.5 bg-[#1b4340]/30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                            </div>
                                        @else
                                            <div class="mb-2 text-[10px] text-gray-400 font-bold tracking-wider uppercase">
                                                Status: <span class="text-yellow-500">{{ $pesanan->status_cucian }}</span>
                                            </div>
                                            <form action="{{ route('kasir.order.ambil', $pesanan->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" onclick="return confirm('Konfirmasi pakaian ini telah diambil oleh pelanggan?')" class="bg-[#1b4340] border border-[#4bd3b6]/50 hover:bg-[#20504d] text-[#4bd3b6] px-4 py-2 rounded-lg font-bold text-xs transition tracking-wide shadow-sm w-full">
                                                    Konfirm Pengambilan>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500 italic flex flex-col items-center justify-center">
                                        <svg class="w-12 h-12 text-gray-700 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        Pencarian tidak menemukan riwayat transaksi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="bg-[#12141c] border-t border-gray-800">
                    <div class="px-8 py-4 flex justify-between items-center border-b border-gray-800">
                        <span class="text-gray-500 text-sm">Menampilkan {{ $riwayat->count() }} pesanan</span>
                        <div class="flex items-center gap-3 text-gray-400 font-bold text-sm">
                            <svg class="w-4 h-4 cursor-pointer hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                            1 / 1
                            <svg class="w-4 h-4 cursor-pointer hover:text-white transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                    <div class="px-8 py-4 text-gray-400 text-sm italic">
                        Batas maksimal pakaian SELESAI adalah 7x24 jam sebelum dialihkan otomatis ke status Tidak Diambil.
                    </div>
                </div>

            </div>
        </div>
    </main>

    <script>
        function updateClock() {
            const now = new Date();
            const optionsDate = { day: 'numeric', month: 'short', year: 'numeric' };
            document.getElementById('realtime-clock').textContent = `${now.toLocaleDateString('id-ID', optionsDate)} || ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
        }
        setInterval(updateClock, 1000); updateClock();

        document.addEventListener('click', function(event) {
            const filterMenu = document.getElementById('filterMenu');
            const filterTombol = filterMenu.previousElementSibling;
            if (!filterTombol.contains(event.target) && !filterMenu.contains(event.target)) {
                filterMenu.classList.add('hidden');
            }
        });
    </script>
    
</body>
</html>