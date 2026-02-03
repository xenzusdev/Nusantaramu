<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lupa Kata Sandi - Nusantaramu</title>
    
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
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Keamanan Akun <br>Adalah Prioritas.</h2>
                    <p class="text-emerald-200 text-lg max-w-md leading-relaxed">
                        Kami akan membantu memulihkan akses akun Anda agar Anda dapat kembali berkontribusi untuk lingkungan.
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

                <div class="mb-8">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 text-emerald-600 text-2xl border border-emerald-100">
                        <i class="fa-solid fa-key"></i>
                    </div>
                    <h3 class="text-3xl font-extrabold text-slate-900">Lupa Kata Sandi?</h3>
                    <p class="text-slate-500 mt-3 leading-relaxed">
                        Jangan khawatir. Masukkan alamat email yang terdaftar, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
                    </p>
                </div>

                @if (session('status'))
                    <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-100 flex items-start gap-3">
                        <i class="fa-solid fa-circle-check text-emerald-600 mt-1"></i>
                        <p class="text-sm text-emerald-700 font-medium">{{ session('status') }}</p>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" :value="old('email')" required autofocus 
                                class="w-full px-5 py-4 pl-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="contoh@siswa.smk.id">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-2 block flex items-center gap-1">
                                <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-lg rounded-full hover:shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                        Kirim Tautan Reset <i class="fa-solid fa-paper-plane text-sm"></i>
                    </button>
                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('login') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 hover:text-emerald-600 transition group">
                        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                        Kembali ke Halaman Masuk
                    </a>
                </div>
                
                <div class="lg:hidden mt-8 text-center">
                    <p class="text-xs text-slate-400">&copy; 2026 Nusantaramu - Smart Waste Smart Future. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>