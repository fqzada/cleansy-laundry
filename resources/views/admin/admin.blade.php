<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleansy Laundry - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN untuk merender grafik analitik -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #2a2f3e; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#12141c] text-white font-sans h-screen flex overflow-hidden">

    <!-- SIDEBAR KIRI PANEL ADMIN -->
    <aside class="w-64 bg-[#161922] border-r border-gray-800 flex flex-col justify-between py-6 flex-shrink-0 z-20">
        <div class="flex flex-col gap-10">
            <!-- Brand Logo -->
            <div class="px-6">
                <h2 class="text-[#4bd3b6] text-2xl font-extrabold tracking-wider">Cleansy Laundry</h2>
                <p class="text-gray-500 text-xs font-semibold uppercase tracking-widest mt-1">Admin Panel</p>
            </div>

            <!-- Menu Navigasi Admin -->
            <nav class="flex flex-col px-3 gap-2">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl bg-[#1b4340] text-[#4bd3b6] font-bold border border-[#4bd3b6]/30 shadow-[0_0_15px_rgba(75,211,182,0.1)] transition duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                    Dashboard Analitik
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/50 transition duration-200 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    Konfigurasi Aturan
                </a>

                <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-400 hover:text-white hover:bg-gray-800/50 transition duration-200 font-semibold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Log Audit Kasir
                </a>
            </nav>
        </div>

        <!-- Profil Widget Owner di Kaki Sidebar -->
        <div class="px-4 border-t border-gray-800 pt-4">
            <div class="flex items-center gap-3 bg-[#12141c] p-3 rounded-xl border border-gray-800">
                <div class="w-9 h-9 bg-teal-500 rounded-full flex items-center justify-center text-[#12141c] font-black">BR</div>
                <div>
                    <div class="text-sm font-bold text-white">{{ strtoupper(auth()->user()->name ?? 'BOS RAFI') }}</div>
                    <div class="text-[10px] text-gray-500 font-mono">owner</div>
                </div>
            </div>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#1a1d26]">
        @yield('content')
    </main>

</body>
</html>