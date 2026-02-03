<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun - Nusantaramu</title>
    
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
        .modal-open { overflow: hidden; }
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
                    <h2 class="text-4xl font-extrabold mb-4 leading-tight">Bergabung dengan <br>Gerakan Perubahan.</h2>
                    <p class="text-emerald-200 text-lg max-w-md leading-relaxed">
                        Daftarkan dirimu sekarang. Mulai pilah sampahmu, kumpulkan poinnya, dan rasakan manfaatnya untukmu dan lingkungan.
                    </p>
                </div>
                 <p class="text-sm text-white/50">&copy; 2026 Nusantaramu - Smart Waste Smart Future. All rights reserved.</p>
            </div>
        </div>

        <div class="w-full lg:w-1/2 flex items-center justify-center p-8 relative bg-white bg-noise-subtle overflow-y-auto">
            <div class="w-full max-w-md py-8 lg:py-0">
                 <div class="lg:hidden flex items-center justify-center gap-2 mb-8">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8">
                    <span class="text-xl font-extrabold text-slate-900">NUSANTARAMU</span>
                </div>

                <div class="mb-10">
                    <h3 class="text-3xl font-extrabold text-slate-900">Buat Akun Baru</h3>
                    <p class="text-slate-500 mt-2">Lengkapi data diri Anda untuk memulai.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label for="name" class="block text-sm font-bold text-slate-700 mb-2">Nama Lengkap</label>
                        <div class="relative">
                            <input id="name" type="text" name="name" :value="old('name')" required autofocus 
                                class="w-full px-5 py-4 pl-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="Masukkan nama lengkap">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-user"></i>
                            </div>
                        </div>
                        @error('name')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-bold text-slate-700 mb-2">Alamat Email</label>
                        <div class="relative">
                            <input id="email" type="email" name="email" :value="old('email')" required 
                                class="w-full px-5 py-4 pl-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="contoh@email.com">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-regular fa-envelope"></i>
                            </div>
                        </div>
                        @error('email')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-bold text-slate-700 mb-2">Kata Sandi</label>
                        <div class="relative">
                            <input id="password" type="password" name="password" required autocomplete="new-password" 
                                class="w-full px-5 py-4 pl-12 pr-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="Minimal 8 karakter">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <button type="button" onclick="togglePassword('password', 'togglePassIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i id="togglePassIcon" class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-bold text-slate-700 mb-2">Konfirmasi Kata Sandi</label>
                        <div class="relative">
                            <input id="password_confirmation" type="password" name="password_confirmation" required 
                                class="w-full px-5 py-4 pl-12 pr-12 rounded-xl bg-slate-50 border border-slate-200 text-slate-900 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition placeholder:text-slate-400" 
                                placeholder="Ulangi kata sandi">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-solid fa-lock"></i>
                            </div>
                            <button type="button" onclick="togglePassword('password_confirmation', 'toggleConfPassIcon')" class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-slate-600 focus:outline-none">
                                <i id="toggleConfPassIcon" class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="flex items-start pt-2">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" name="terms" required class="w-4 h-4 text-emerald-600 bg-slate-100 border-slate-300 rounded focus:ring-emerald-500 focus:ring-2 cursor-pointer">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-slate-600 cursor-pointer">
                                Saya menyetujui <button type="button" onclick="openModal('termsModal')" class="text-emerald-600 font-bold hover:underline focus:outline-none">Syarat & Ketentuan</button> serta <button type="button" onclick="openModal('privacyModal')" class="text-emerald-600 font-bold hover:underline focus:outline-none">Kebijakan Privasi</button> yang berlaku.
                            </label>
                            @error('terms')
                                <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="w-full py-4 px-6 bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold text-lg rounded-full hover:shadow-lg hover:shadow-emerald-500/30 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                        Daftar Sekarang <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <p class="text-center text-sm text-slate-500 mt-8 font-medium">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-emerald-600 font-bold hover:underline">Masuk di sini</a>
                </p>
                
                <div class="lg:hidden mt-8 text-center">
                    <p class="text-xs text-slate-400">&copy; 2026 Nusantaramu - Smart Waste Smart Future. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <div id="termsModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/50 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeModal('termsModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            
            <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-slate-900 mb-4" id="modal-title">Syarat & Ketentuan</h3>
                    <div class="mt-2 text-sm text-slate-600 space-y-3 h-64 overflow-y-auto pr-2">
                        <p>Selamat datang di Nusantaramu. Dengan mendaftar, Anda setuju:</p>
                        <p><strong>1. Akun:</strong> Jaga kerahasiaan akun. Dilarang menggunakan data palsu.</p>
                        <p><strong>2. Sampah:</strong> Hanya setor botol plastik, cup, dan kaleng sesuai ketentuan alat.</p>
                        <p><strong>3. Poin:</strong> Poin dihitung otomatis oleh sensor. Kecurangan akan menyebabkan ban akun.</p>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-emerald-600 text-base font-bold text-white hover:bg-emerald-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal('termsModal')">Saya Mengerti</button>
                </div>
            </div>
        </div>
    </div>

    <div id="privacyModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 bg-slate-900/50 bg-opacity-75 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeModal('privacyModal')"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="relative inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-6 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-xl leading-6 font-bold text-slate-900 mb-4">Kebijakan Privasi</h3>
                    <div class="mt-2 text-sm text-slate-600 space-y-3 h-64 overflow-y-auto pr-2">
                        <p>Kami menghargai privasi Anda:</p>
                        <p><strong>1. Data:</strong> Kami menyimpan Nama & Email untuk keperluan akun.</p>
                        <p><strong>2. Keamanan:</strong> Data Anda dilindungi enkripsi standar industri.</p>
                        <p><strong>3. Pihak Ketiga:</strong> Data tidak dijual. Hanya dibagikan ke mitra donasi jika Anda menggunakan fitur sedekah.</p>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-4 sm:flex sm:flex-row-reverse">
                    <button type="button" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-6 py-3 bg-emerald-600 text-base font-bold text-white hover:bg-emerald-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm" onclick="closeModal('privacyModal')">Saya Mengerti</button>
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

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
            document.body.classList.remove('modal-open');
        }
    </script>
</body>
</html>