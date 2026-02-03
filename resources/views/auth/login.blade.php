<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk - Nusantaramu</title>
    
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-noise-subtle {
             background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.03'/%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="bg-slate-50">

    <div class="min-h-screen flex">
        
        <div class="hidden lg:flex lg:w-1/2 relative bg-slate-900 overflow-hidden">
            <img src="{{ asset('img/hero.png') }}" alt="Banner" class="absolute inset-0 w-full h-full object-cover opacity-60 scale-105 translate-y-4 transition-transform duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/90 via-slate-900/50 to-slate-900/30"></div>
            
            <div class="relative z-10 w-full flex flex-col justify-between p-16 text-white">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/10">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-6 h-6 object-contain brightness-0 invert">
                    </div>
                    <span class="text-xl font-extrabold tracking-tight">NUSANTARAMU</span>
                </div>
                
                <div class="mb-10">
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Selamat Datang Kembali, <br>Pahlawan Lingkungan.</h2>
                    <p class="text-emerald-200 text-lg max-w-md leading-relaxed">
                        Lanjutkan kontribusimu dalam mengubah sampah menjadi kebaikan. Setiap login adalah langkah baru menuju bumi yang lebih hijau.
                    </p>
                </div>
                <p class="text-sm text-white/50">&copy; 2026 Nusantaramu - Smart Waste Smart Future. All rights reserved.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative bg-white bg-noise-subtle">
            <div class="w-full max-w-md">
                 <div class="lg:hidden flex items-center justify-center gap-2 mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8">
                    <span class="text-xl font-extrabold text-slate-900">NUSANTARAMU</span>
                </div>

                <div class="mb-10">
                    <h3 class="text-3xl font-extrabold text-slate-900">Masuk ke Akun</h3>
                    <p class="text-slate-500 mt-2">Masukkan detail akun Anda untuk mengakses dashboard.</p>
                </div>

                @if (session('status'))
                    <div class="mb-4 p-4 rounded-xl bg-emerald-50 text-emerald-700 text-sm font-medium border border-emerald-100">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email / NISN</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                class="w-full px-5 py-4 pl-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="contoh@siswa.smk.id">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-bold text-slate-700">Kata Sandi</label>
                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 font-bold hover:underline">
                                    Lupa password?
                                </a>
                            @endif
                        </div>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="current-password" 
                                class="w-full px-5 py-4 pl-12 pr-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="••••••••">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <button type="button" onclick="togglePassword('password', 'toggleIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i id="toggleIcon" class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                         @error('password')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500 focus:ring-2">
                        <label for="remember_me" class="ml-2 block text-sm text-slate-600 font-medium">
                            Ingat saya di perangkat ini
                        </label>
                    </div>

                    <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-lg rounded-full hover:shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                        Masuk Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-8 font-medium">
                    Belum menjadi bagian dari kami? 
                    <a href="{{ route('register') }}" class="text-emerald-600 font-bold hover:underline">Buat Akun Baru</a>
                </p>
                
                <div class="lg:hidden mt-8 text-center">
                    <p class="text-xs text-slate-400">&copy; 2026 Nusantaramu - Smart Waste Smart Future. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>