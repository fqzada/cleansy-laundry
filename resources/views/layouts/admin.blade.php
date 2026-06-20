<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cleansy Laundry - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #2a2f3e; border-radius: 10px; }
    </style>
</head>
<body class="bg-[#0f1115] text-white font-sans h-screen flex overflow-hidden">

    <!-- SIDEBAR KIRI (Desain Dikembalikan ke Mockup) -->
    <aside class="w-64 bg-[#12141c] border-r border-gray-800 flex flex-col justify-between py-8 flex-shrink-0 z-20">
        <div class="flex flex-col gap-10">
            <!-- Brand Logo -->
            <div class="px-8">
                <h2 class="text-[#4bd3b6] text-2xl font-bold tracking-wide">Cleansy Loundry</h2>
                <p class="text-gray-500 text-sm mt-1">Admin Panel</p>
            </div>

            <!-- Menu Navigasi -->
            <nav class="flex flex-col gap-2 pr-4">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-4 px-8 py-3.5 transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-[#1b4340]/40 text-[#4bd3b6] font-bold border-l-4 border-[#4bd3b6] rounded-r-xl' : 'text-gray-400 hover:text-white font-semibold border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"></path></svg>
                    Dashboard Analitik
                </a>

                <a href="{{ route('admin.settings') }}" class="flex items-center gap-4 px-8 py-3.5 transition duration-200 {{ request()->routeIs('admin.settings') ? 'bg-[#1b4340]/40 text-[#4bd3b6] font-bold border-l-4 border-[#4bd3b6] rounded-r-xl' : 'text-gray-400 hover:text-white font-semibold border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                    Konfigurasi Aturan
                </a>

                <a href="{{ route('admin.audit') }}" class="flex items-center gap-4 px-8 py-3.5 transition duration-200 {{ request()->routeIs('admin.audit') ? 'bg-[#1b4340]/40 text-[#4bd3b6] font-bold border-l-4 border-[#4bd3b6] rounded-r-xl' : 'text-gray-400 hover:text-white font-semibold border-l-4 border-transparent' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Log Audit Kasir
                </a>
            </nav>
        </div>

        <!-- Profil Footer -->
        <div class="px-8 border-t border-gray-800 pt-6">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-[#4bd3b6] rounded-full flex items-center justify-center text-[#12141c]">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <div>
                    <div class="text-sm font-bold text-[#4bd3b6]">{{ strtoupper(auth()->user()->name ?? 'BOS RAFI') }}</div>
                    <div class="text-xs text-gray-500">owner</div>
                </div>
            </div>
        </div>
    </aside>

    <main class="flex-1 flex flex-col h-screen overflow-hidden bg-[#161922]">
        @yield('content')
    </main>

</body>
</html>