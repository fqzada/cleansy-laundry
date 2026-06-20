@extends('layouts.admin')

@section('content')
<header class="h-20 flex justify-between items-center px-10 border-b border-gray-800 flex-shrink-0 bg-[#161922]">
    <div class="text-sm text-gray-400 font-medium">
        Owner > <span class="text-[#4bd3b6]">Konfigurasi Aturan</span>
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

<form action="{{ route('admin.settings.update') }}" method="POST" class="flex-1 flex flex-col h-full overflow-hidden relative bg-[#161922]">
    @csrf

    <div class="flex-1 overflow-y-auto p-10 pb-32">
        <div class="max-w-6xl flex flex-col gap-8">
            
            @if(session('success'))
                <div class="bg-[#1b4340] border border-[#4bd3b6]/50 text-[#4bd3b6] px-6 py-4 rounded-xl font-bold flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Kartu 1: Cucian Telantar -->
                <div class="bg-transparent border border-gray-800 p-8 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-[#4bd3b6] text-sm font-bold flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            Aturan Status Cucian Telantar
                        </h3>
                        <p class="text-[13px] text-gray-400 leading-relaxed mt-4">Atur batas waktu maksimal pakaian berstatus 'Siap Diambil' sebelum berubah menjadi 'Tidak Diambil'.</p>
                    </div>
                    <div class="mt-8 flex gap-4">
                        <div class="flex items-center bg-[#1a1d26] border border-gray-800 rounded-xl p-1.5 w-1/2">
                            <button type="button" onclick="document.getElementById('tel_angka').stepDown()" class="w-10 h-10 flex items-center justify-center bg-gray-800 hover:bg-gray-700 text-white rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4"></path></svg></button>
                            <input type="number" id="tel_angka" name="telantar_angka" value="{{ $settings['telantar_angka'] ?? '3' }}" class="w-full bg-transparent text-center text-[#4bd3b6] font-bold text-lg outline-none appearance-none">
                            <button type="button" onclick="document.getElementById('tel_angka').stepUp()" class="w-10 h-10 flex items-center justify-center bg-[#1b4340] hover:bg-[#20504d] text-[#4bd3b6] rounded-lg transition"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg></button>
                        </div>
                        <div class="relative w-1/2">
                            <select name="telantar_satuan" class="w-full h-full bg-[#1a1d26] border border-gray-800 rounded-xl px-4 appearance-none text-sm text-gray-300 outline-none">
                                <option value="Hari" {{ ($settings['telantar_satuan'] ?? '') == 'Hari' ? 'selected' : '' }}>Hari (24 Jam)</option>
                                <option value="Minggu" {{ ($settings['telantar_satuan'] ?? '') == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                            </select>
                            <svg class="w-4 h-4 absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    <p class="text-[11px] text-gray-500 italic mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Sistem akan mendeteksi otomatis nota yang melewati batas.
                    </p>
                </div>

                <!-- Kartu 2: Toleransi -->
                <div class="bg-transparent border border-gray-800 p-8 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-[#4bd3b6] text-sm font-bold flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Atur Batas Toleransi Selisih Kasir
                        </h3>
                        <p class="text-[13px] text-gray-400 leading-relaxed mt-4">Masukkan nominal maksimal selisih uang fisik di laci kasir yang disetujui otomatis oleh sistem saat tutup shift.</p>
                    </div>
                    <div class="mt-8 bg-[#1a1d26] border border-gray-800 rounded-xl flex items-center px-5 py-4 focus-within:border-gray-600">
                        <span class="text-gray-500 font-medium mr-3">Rp</span>
                        <input type="number" name="toleransi_selisih" value="{{ $settings['toleransi_selisih'] ?? '1000' }}" class="bg-transparent text-gray-300 w-full outline-none font-medium text-base">
                    </div>
                    <p class="text-[11px] text-[#f17a5d] mt-3 flex items-center gap-1 font-medium">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        Selisih di atas nominal ini memerlukan persetujuan manual Owner.
                    </p>
                </div>

                <!-- Kartu Tambahan: Limit Express (Disesuaikan gayanya) -->
                <div class="bg-transparent border border-gray-800 p-8 rounded-2xl flex flex-col justify-between">
                    <div>
                        <h3 class="text-[#f17a5d] text-sm font-bold flex items-center gap-2 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            Limit Kapasitas Express
                        </h3>
                        <p class="text-[13px] text-gray-400 leading-relaxed mt-4">Atur batas maksimal pesanan Express harian untuk mencegah penumpukan mesin.</p>
                    </div>
                    <div class="mt-8 bg-[#1a1d26] border border-gray-800 rounded-xl flex items-center px-5 py-4 focus-within:border-gray-600">
                        <input type="number" name="kapasitas_express" value="{{ $settings['kapasitas_express'] ?? '10' }}" class="bg-transparent text-[#f17a5d] font-bold w-full outline-none text-center text-lg">
                        <span class="text-gray-500 font-medium ml-3 border-l border-gray-700 pl-4">Nota / Hari</span>
                    </div>
                </div>

            </div>

            <!-- Jam Operasional -->
            <div class="bg-transparent border border-gray-800 p-8 rounded-2xl mt-4">
                <div class="flex justify-between items-center mb-8">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#4bd3b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="text-[#4bd3b6] text-sm font-bold">Konfigurasi Jam Operasional & Lembur</h3>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs text-gray-400">Aktifkan Alarm Peringatan Lembur Otomatis jika staf masih aktif melewati jam keluar</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="alarm_aktif" value="1" class="sr-only peer" {{ ($settings['alarm_aktif'] ?? '1') ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-700 rounded-full peer peer-checked:after:translate-x-full after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-[#161922] after:border-gray-300 after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#4bd3b6]"></div>
                        </label>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="text-[13px] text-gray-400 mb-2 block">Jam Masuk</label>
                        <div class="bg-[#1a1d26] border border-gray-800 rounded-xl p-4 flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#4bd3b6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                            <input type="time" name="jam_masuk" value="{{ $settings['jam_masuk'] ?? '08:00' }}" class="bg-transparent text-gray-300 font-medium outline-none w-full [color-scheme:dark]">
                        </div>
                    </div>
                    <div>
                        <label class="text-[13px] text-gray-400 mb-2 block">Jam Keluar Reguler</label>
                        <div class="bg-[#1a1d26] border border-gray-800 rounded-xl p-4 flex items-center gap-3">
                            <svg class="w-5 h-5 text-[#f17a5d]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                            <input type="time" name="jam_keluar" value="{{ $settings['jam_keluar'] ?? '22:00' }}" class="bg-transparent text-gray-300 font-medium outline-none w-full [color-scheme:dark]">
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Tombol Bawah -->
    <div class="fixed bottom-0 left-64 right-0 bg-[#161922] border-t border-gray-800 px-10 py-5 z-20 flex justify-end gap-4">
        <button type="reset" class="px-6 py-3 rounded-lg bg-[#1a1d26] border border-gray-700 text-gray-400 text-sm hover:text-white transition">
            Reset ke Default
        </button>
        <button type="submit" class="px-6 py-3 rounded-lg bg-[#4bd3b6] hover:bg-[#3db097] text-[#161922] font-bold text-sm flex items-center gap-2 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
            Simpan Perubahan Aturan
        </button>
    </div>
</form>

<script>
    setInterval(() => {
        const now = new Date();
        document.getElementById('realtime-clock').textContent = `${now.toLocaleDateString('id-ID', { day: 'numeric', month: 'short', year: 'numeric' })} || ${now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' })}`;
    }, 1000);
</script>
@endsection