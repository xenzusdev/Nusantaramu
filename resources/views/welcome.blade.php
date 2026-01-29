<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Nusantaramu - Smart Waste Bank</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gray-50 font-figtree">
    
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="#" class="text-2xl font-black text-green-600 tracking-tighter">
                        NUSANTARAMU
                    </a>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-900 hover:text-green-600 transition">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-semibold text-gray-500 hover:text-gray-900 transition">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-5 py-2.5 text-sm font-medium text-white bg-green-600 rounded-full hover:bg-green-700 transition shadow-lg shadow-green-600/30">
                                    Daftar Sekarang
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <div class="relative pt-32 pb-20 sm:pt-40 sm:pb-24 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl sm:text-7xl font-extrabold text-gray-900 tracking-tight mb-8">
                Ubah Sampah Jadi <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-500 to-emerald-700 animate-pulse">
                    Cuan & Kebaikan
                </span>
            </h1>
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto mb-10">
                Ekosistem Bank Sampah Pintar berbasis IoT. Dukung lingkungan bersih, dapatkan saldo e-wallet, atau sedekahkan langsung.
            </p>
            <div class="flex justify-center gap-4">
                <a href="{{ route('register') }}" class="px-8 py-4 text-lg font-bold text-white bg-gray-900 rounded-xl hover:bg-gray-800 transition transform hover:-translate-y-1 shadow-xl">
                    Mulai Sekarang
                </a>
                <a href="#how-it-works" class="px-8 py-4 text-lg font-bold text-gray-700 bg-white border border-gray-200 rounded-xl hover:border-green-500 hover:text-green-600 transition">
                    Pelajari Cara Kerja
                </a>
            </div>
        </div>
    </div>

    <div id="how-it-works" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base font-semibold text-green-600 tracking-wide uppercase">Alur Proses</h2>
                <p class="mt-2 text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Mudah, Cepat, Otomatis
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-green-200 transition duration-300 hover:shadow-xl">
                    <div class="w-14 h-14 bg-green-100 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition">
                        📲
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">1. Scan QR Code</h3>
                    <p class="text-gray-500">
                        Scan QR yang ada di dinding alat NUSANTARAMU menggunakan HP kamu untuk login otomatis.
                    </p>
                </div>

                <div class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-green-200 transition duration-300 hover:shadow-xl">
                    <div class="w-14 h-14 bg-blue-100 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition">
                        ♻️
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">2. Masukkan Sampah</h3>
                    <p class="text-gray-500">
                        Sistem IoT akan memilah anorganik (botol) dan organik secara otomatis menggunakan AI.
                    </p>
                </div>

                <div class="group relative p-8 bg-gray-50 rounded-3xl border border-gray-100 hover:border-green-200 transition duration-300 hover:shadow-xl">
                    <div class="w-14 h-14 bg-orange-100 rounded-2xl flex items-center justify-center mb-6 text-2xl group-hover:scale-110 transition">
                        💰
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">3. Tarik Saldo</h3>
                    <p class="text-gray-500">
                        Poin langsung masuk ke akunmu. Tukarkan jadi saldo E-Wallet atau donasikan ke Lazismu.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row justify-between items-center">
            <div class="text-white font-bold text-xl mb-4 md:mb-0">
                NUSANTARAMU
            </div>
            <div class="text-gray-400 text-sm">
                &copy; 2024 Olympicad Project - SMK Muhammadiyah Kudus.
            </div>
        </div>
    </footer>
</body>
</html>
