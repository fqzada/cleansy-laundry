<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Cleansy Laundry</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#12141c] min-h-screen flex items-center justify-center relative font-sans">

    <div class="absolute bottom-6 right-8 text-gray-600 text-xs font-semibold tracking-wider">
        © 2026 Cleansy Laundry Kelompok 3
    </div>

    <div class="max-w-5xl w-full flex flex-col md:flex-row items-center justify-center gap-12 md:gap-24 p-6">
        
        <div class="flex flex-col items-center text-center">
            <div class="w-40 h-40 bg-[#cbf2ea] rounded-3xl flex items-center justify-center shadow-lg mb-6 border-[6px] border-[#161922] relative overflow-hidden">
                <div class="absolute inset-0 border border-gray-700 rounded-3xl"></div>
                <svg class="w-24 h-24 text-[#ff5f8e]" fill="currentColor" viewBox="0 0 24 24"><path d="M19 2H5C3.343 2 2 3.343 2 5v14c0 1.657 1.343 3 3 3h14c1.657 0 3-1.343 3-3V5c0-1.657-1.343-3-3-3zm-7 16c-3.313 0-6-2.687-6-6s2.687-6 6-6 6 2.687 6 6-2.687 6-6 6zm5-13H7V4h10v1z"/><circle cx="12" cy="12" r="4" fill="#4bd3b6"/></svg>
            </div>
            <h1 class="text-5xl font-bold text-[#4bd3b6] mb-1 tracking-wide">Cleansy</h1>
            <h1 class="text-5xl font-bold text-[#4bd3b6] mb-6 tracking-wide">Laundry</h1>
            <p class="text-gray-400 text-lg">“Management System</p>
            <p class="text-gray-400 text-lg mb-8">Laundry”</p>
            
            <div class="flex gap-2">
                <div class="w-2 h-2 rounded-full bg-gray-600"></div>
                <div class="w-8 h-2 rounded-full bg-[#4bd3b6]"></div>
                <div class="w-2 h-2 rounded-full bg-gray-600"></div>
            </div>
        </div>

        <div class="bg-white p-10 lg:p-12 rounded-[2rem] w-full max-w-md shadow-2xl">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Masuk ke<br>Sistem</h2>
            <p class="text-gray-500 text-sm mb-8 leading-relaxed">Silakan masuk untuk<br>mengelola operasional<br>laundry Anda.</p>

            @if ($errors->any())
                <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative text-sm">
                    Email atau Password salah!
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
<input type="hidden" name="role" id="roleInput" value="kasir">
                <div class="mb-6">
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-widest mb-2">Pilih Peran</label>
                    <div class="flex bg-gray-100 p-1 rounded-xl relative">
                        <div id="btn-kasir" onclick="switchRole('kasir')" class="w-1/2 flex items-center justify-center gap-2 py-2.5 bg-white rounded-lg shadow-sm text-[#4bd3b6] font-bold text-sm border border-gray-200 cursor-pointer transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            Kasir
                        </div>
                        <div id="btn-admin" onclick="switchRole('admin')" class="w-1/2 flex items-center justify-center gap-2 py-2.5 text-gray-500 font-bold text-sm border border-transparent cursor-pointer hover:text-gray-700 transition-all duration-300">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            Admin
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-xs font-bold text-gray-500 mb-1">Username / Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus placeholder="nama@cleansy.com" class="w-full pl-11 pr-4 py-3.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#4bd3b6] focus:ring-1 focus:ring-[#4bd3b6] transition">
                    </div>
                </div>

                <div class="mb-8">
                    <div class="flex justify-between items-center mb-1">
                        <label class="block text-xs font-bold text-gray-500">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-[#4bd3b6] hover:text-[#3db097] tracking-wide">Lupa?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        </div>
                        <input type="password" name="password" required placeholder="••••••••" class="w-full pl-11 pr-4 py-3.5 border border-gray-300 rounded-xl text-sm focus:outline-none focus:border-[#4bd3b6] focus:ring-1 focus:ring-[#4bd3b6] transition">
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#4bd3b6] hover:bg-[#3db097] text-white font-bold py-3.5 rounded-xl shadow-[0_10px_20px_rgba(75,211,182,0.3)] transition duration-200 flex items-center justify-center gap-2 text-lg">
                    Masuk 
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </form>
        </div>

    </div>
    <script>
        function switchRole(role) {
            // Ubah nilai input tersembunyi yang akan dikirim ke server
            document.getElementById('roleInput').value = role;
            
            const btnKasir = document.getElementById('btn-kasir');
            const btnAdmin = document.getElementById('btn-admin');

            const activeStyle = ['bg-white', 'shadow-sm', 'text-[#4bd3b6]', 'border-gray-200'];
            const inactiveStyle = ['text-gray-500', 'border-transparent', 'hover:text-gray-700'];

            if (role === 'kasir') {
                btnKasir.classList.remove(...inactiveStyle);
                btnKasir.classList.add(...activeStyle);
                btnAdmin.classList.remove(...activeStyle);
                btnAdmin.classList.add(...inactiveStyle);
            } else {
                btnAdmin.classList.remove(...inactiveStyle);
                btnAdmin.classList.add(...activeStyle);
                btnKasir.classList.remove(...activeStyle);
                btnKasir.classList.add(...inactiveStyle);
            }
        }
    </script>
</body>
</html>