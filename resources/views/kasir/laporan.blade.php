<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kas - Cleansy Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #374151; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#12141c] text-white font-sans h-screen flex overflow-hidden">

    <!-- SIDEBAR KIRI -->
    <aside class="w-16 md:w-20 bg-[#161922] border-r border-gray-800 flex flex-col items-center py-6 gap-8 flex-shrink-0 z-10">
        <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center p-1 shadow-[0_0_15px_rgba(64,196,170,0.3)] mb-4">
            <span class="text-xs font-bold text-teal-600">CL</span>
        </div>
        
        <!-- Ikon 1: POS -->
        <a href="{{ route('kasir.dashboard') }}" title="Kasir & POS" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white transition cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
        </a>
        
        <!-- Ikon 2: RIWAYAT -->
        <a href="{{ route('kasir.riwayat') }}" title="Riwayat Transaksi" class="w-10 h-10 flex items-center justify-center text-gray-500 hover:text-white transition cursor-pointer">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
        </a>
        
        <!-- Ikon 3: LAPORAN (AKTIF) -->
        <div title="Laporan Kas & Rekonsiliasi" class="w-10 h-10 bg-[#1b4340] border border-[#4bd3b6]/50 rounded-xl flex items-center justify-center text-[#4bd3b6] shadow-[0_0_10px_rgba(75,211,182,0.2)] cursor-default">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#1a1d26] relative">
        
        <!-- HEADER -->
        <header class="h-24 flex justify-between items-center px-8 lg:px-12 flex-shrink-0 mt-2 border-b border-gray-800 pb-4 mb-6">
            <div>
                <h2 class="text-[#4bd3b6] text-xl font-bold tracking-wide mb-1">Cleansy Laundry</h2>
                <h1 class="text-3xl font-extrabold text-white tracking-wide">Laporan Kas & Rekonsiliasi</h1>
            </div>
            <div class="text-right">
                <div class="text-sm font-bold text-gray-300 uppercase tracking-widest">SHF- 1-</div>
                <div class="text-sm font-bold text-gray-300 uppercase tracking-widest">{{ strtoupper(auth()->user()->name ?? 'KASIR') }}</div>
            </div>
        </header>

        <!-- AREA KERJA: 2 KOLOM -->
        <div class="flex-1 overflow-y-auto px-8 lg:px-12 py-6 mb-24">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-5xl">
                
                <!-- KOLOM KIRI: RINGKASAN PENDAPATAN SISTEM -->
                <div class="flex flex-col">
                    <h2 class="text-[#4bd3b6] text-sm font-bold flex items-center gap-2 mb-4 tracking-wide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Ringkasan Pendapatan Sistem
                    </h2>

                    <div class="bg-[#242835] rounded-3xl p-6 shadow-lg flex flex-col gap-6">
                        <div class="bg-[#1a1d26] p-5 rounded-2xl relative">
                            <svg class="w-5 h-5 text-gray-500 absolute right-5 top-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-gray-400 font-semibold mb-1">Total Transaksi Tunai<br>(Cash)</p>
                            <p class="text-2xl font-bold text-white">Rp{{ number_format($tunai_sistem ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-[#1a1d26] p-5 rounded-2xl relative">
                            <svg class="w-5 h-5 text-gray-500 absolute right-5 top-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <p class="text-xs text-gray-400 font-semibold mb-1">Total Transaksi Non-Tunai<br>(QRIS)</p>
                            <p class="text-2xl font-bold text-white">Rp{{ number_format($qris_sistem ?? 0, 0, ',', '.') }}</p>
                        </div>

                        <div class="border-2 border-[#1b4340] bg-[#1a1d26] p-5 rounded-2xl mt-4">
                            <p class="text-sm text-[#4bd3b6] font-extrabold mb-1">Total<br>Tunai<br>Sesungguhnya</p>
                            <p class="text-4xl font-extrabold text-[#4bd3b6] mt-2">Rp{{ number_format($tunai_sistem ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN: VERIFIKASI UANG FISIK (NUMPAD) -->
                <div class="flex flex-col">
                    <h2 class="text-[#4bd3b6] text-sm font-bold flex items-center gap-2 mb-4 tracking-wide">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Verifikasi Uang Fisik di Laci
                    </h2>

                    <div class="bg-[#242835] rounded-3xl p-6 shadow-lg flex flex-col">
                        <p class="text-[10px] text-gray-300 font-bold uppercase tracking-widest mb-3">Masukkan Jumlah Total Uang Fisik Riil</p>
                        
                        <div class="bg-[#1a1d26] border border-gray-700 rounded-2xl p-5 mb-5 flex items-center">
                            <span class="text-[#4bd3b6] font-bold text-lg mr-3">Rp</span>
                            <input type="text" id="displayFisik" class="bg-transparent border-none outline-none text-white text-5xl font-extrabold w-full" value="0" readonly>
                        </div>

                        <!-- Numpad Kalkulator -->
                        <div class="grid grid-cols-3 gap-3 mb-5">
                            <button onclick="ketik('1')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">1</button>
                            <button onclick="ketik('2')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">2</button>
                            <button onclick="ketik('3')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">3</button>
                            <button onclick="ketik('4')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">4</button>
                            <button onclick="ketik('5')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">5</button>
                            <button onclick="ketik('6')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">6</button>
                            <button onclick="ketik('7')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">7</button>
                            <button onclick="ketik('8')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">8</button>
                            <button onclick="ketik('9')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">9</button>
                            <button onclick="bersihkan()" class="bg-[#1a1d26] hover:bg-gray-700 text-gray-400 font-bold py-4 rounded-xl transition text-xl">C</button>
                            <button onclick="ketik('0')" class="bg-[#1a1d26] hover:bg-gray-700 text-white font-bold py-4 rounded-xl transition text-xl">0</button>
                            <button onclick="hapusSatu()" class="bg-[#1a1d26] hover:bg-gray-700 text-gray-400 font-bold py-4 rounded-xl transition flex justify-center items-center">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z"></path></svg>
                            </button>
                        </div>

                        <button onclick="hitungAudit()" class="w-full bg-[#4bd3b6] hover:bg-[#3db097] text-[#12141c] font-bold py-3.5 rounded-xl transition flex justify-center items-center gap-2 shadow-lg mb-5">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            SUBMIT
                        </button>

                        <!-- Kotak Hasil Audit -->
                        <div id="boxAudit" class="hidden bg-[#1a1d26] border-l-4 rounded-r-xl p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-xs font-bold text-gray-400">Selisih Kas</span>
                                <span id="textSelisih" class="text-lg font-extrabold">Rp0</span>
                            </div>
                            <div class="flex gap-2">
                                <svg id="iconAudit" class="w-4 h-4 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <div>
                                    <p id="judulAudit" class="text-xs font-bold uppercase tracking-wide"></p>
                                    <p id="descAudit" class="text-[10px] text-gray-400 mt-1 leading-tight"></p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

        <!-- FOOTER BAR -->
        <div class="absolute bottom-0 w-full bg-[#12141c] border-t border-gray-800 flex justify-between items-center px-12 py-5 z-20">
            <div class="flex items-center gap-10 text-xs text-gray-500 font-semibold tracking-wide">
                <span>© Cleansy<br>Laundry</span>
                <span class="w-1 h-1 bg-gray-600 rounded-full"></span>
                <span>Status Server:<br>Ping Bagus</span>
            </div>
            
            <!-- Tombol Tutup Kasir & Shift -->
            <form action="{{ route('kasir.shift.end') }}" method="POST" id="formTutupShift">
                @csrf
                <input type="hidden" name="uang_fisik" id="hiddenFisik" value="0">
                <input type="hidden" name="selisih" id="hiddenSelisih" value="0">
                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin Submit Laporan dan Tutup Shift Kasir sekarang? Ini akan mengeluarkan akun Anda dari sistem.')" class="bg-[#4bd3b6] hover:bg-[#3db097] text-[#12141c] font-bold text-lg px-8 py-4 rounded-full transition shadow-[0_0_20px_rgba(75,211,182,0.3)] flex items-center gap-4">
                    Submit Laporan & Tutup Kasir
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>

    </main>

    <!-- LOGIKA JAVASCRIPT REKONSILIASI -->
    <script>
        const tunaiSistem = {{ $tunai_sistem ?? 0 }};
        let inputFisikAngka = 0;
        let strFisik = "";
        const displayFisik = document.getElementById('displayFisik');

        function formatRp(angka) {
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function ketik(angka) {
            if(strFisik === "0") strFisik = angka;
            else strFisik += angka;
            updateDisplay();
        }

        function hapusSatu() {
            strFisik = strFisik.slice(0, -1);
            if(strFisik === "") strFisik = "0";
            updateDisplay();
        }

        function bersihkan() {
            strFisik = "0";
            updateDisplay();
            document.getElementById('boxAudit').classList.add('hidden'); 
        }

        function updateDisplay() {
            inputFisikAngka = parseInt(strFisik) || 0;
            displayFisik.value = formatRp(inputFisikAngka);
        }

        function hitungAudit() {
            const selisih = inputFisikAngka - tunaiSistem;
            const boxAudit = document.getElementById('boxAudit');
            const textSelisih = document.getElementById('textSelisih');
            const judulAudit = document.getElementById('judulAudit');
            const descAudit = document.getElementById('descAudit');
            const iconAudit = document.getElementById('iconAudit');

            boxAudit.classList.remove('hidden'); 
            boxAudit.classList.remove('border-[#ff9b70]', 'border-red-500', 'border-[#4bd3b6]');
            textSelisih.classList.remove('text-[#ff9b70]', 'text-red-500', 'text-[#4bd3b6]');
            judulAudit.classList.remove('text-[#ff9b70]', 'text-red-500', 'text-[#4bd3b6]');
            iconAudit.classList.remove('text-[#ff9b70]', 'text-red-500', 'text-[#4bd3b6]');

            if (selisih < 0) {
                textSelisih.textContent = "-Rp" + formatRp(Math.abs(selisih));
            } else if (selisih > 0) {
                textSelisih.textContent = "+Rp" + formatRp(selisih);
            } else {
                textSelisih.textContent = "Rp0";
            }

            const toleransi = 1000;

            if (selisih === 0 || (selisih < 0 && Math.abs(selisih) <= toleransi)) {
                boxAudit.classList.add('border-[#ff9b70]'); 
                textSelisih.classList.add('text-[#ff9b70]');
                judulAudit.classList.add('text-[#ff9b70]');
                iconAudit.classList.add('text-[#ff9b70]');
                judulAudit.textContent = "Status Audit: SELISIH AMAN";
                descAudit.textContent = "Di bawah batas toleransi Rp1.000, sistem menyetujui otomatis tanpa memotong gaji karyawan.";
                iconAudit.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            } 
            else if (selisih > 0) {
                boxAudit.classList.add('border-[#4bd3b6]'); 
                textSelisih.classList.add('text-[#4bd3b6]');
                judulAudit.classList.add('text-[#4bd3b6]');
                iconAudit.classList.add('text-[#4bd3b6]');
                judulAudit.textContent = "Status Audit: UANG LEBIH";
                descAudit.textContent = "Uang fisik melebihi catatan sistem. Harap periksa kembali apakah ada kembalian yang belum diberikan.";
                iconAudit.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>';
            }
            else {
                boxAudit.classList.add('border-red-500'); 
                textSelisih.classList.add('text-red-500');
                judulAudit.classList.add('text-red-500');
                iconAudit.classList.add('text-red-500');
                judulAudit.textContent = "Status Audit: SELISIH FATAL";
                descAudit.textContent = "Kehilangan uang di luar batas toleransi! Memerlukan persetujuan manual Owner (Potong Gaji).";
                iconAudit.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>';
            }

            // MENGIRIM DATA KE FORM
            document.getElementById('hiddenFisik').value = inputFisikAngka;
            document.getElementById('hiddenSelisih').value = selisih;
        }
    </script>
    
</body>
</html>