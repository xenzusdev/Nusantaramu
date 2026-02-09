<x-app-layout>
    <x-slot name="title">Profile Saya</x-slot>
    <x-slot name="header"></x-slot>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        ::-webkit-scrollbar { width: 0px; background: transparent; }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        [x-cloak] { display: none !important; }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" 
         x-data="{ 
            openEdit: {{ $errors->updateProfileInformation->isNotEmpty() ? 'true' : 'false' }}, 
            openPassword: {{ $errors->updatePassword->isNotEmpty() ? 'true' : 'false' }} 
         }">
        
        @if (session('status') === 'profile-updated' || session('status') === 'password-updated')
            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-10"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-y-0"
                 x-transition:leave-end="opacity-0 -translate-y-10"
                 class="fixed top-6 left-1/2 -translate-x-1/2 z-[100] bg-emerald-500 text-white px-6 py-3 rounded-full shadow-2xl flex items-center gap-3 border border-emerald-400/50 backdrop-blur-md">
                <div class="bg-white/20 p-1 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="font-bold text-sm">Berhasil disimpan!</span>
            </div>
        @endif

        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-300/20 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale" alt="Pattern">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-4 sm:px-8">
                <div class="relative flex items-center justify-center mb-8">
                    <a href="{{ route('dashboard') }}" class="absolute left-0 flex items-center gap-2 text-white/80 hover:text-white transition group">
                        <div class="bg-white/10 p-2 rounded-xl group-hover:bg-white/20 transition backdrop-blur-sm">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        </div>
                    </a>
                    <span class="font-bold text-white text-lg tracking-wide">Profile</span>
                </div>

                <div class="flex flex-col items-center text-center text-white mb-6">
                    <div class="w-28 h-28 p-1.5 rounded-full relative mb-4">
                        <div class="absolute inset-0 bg-gradient-to-tr from-white/10 to-white/60 rounded-full blur-md animate-pulse"></div>
                        <div class="w-full h-full bg-white rounded-full flex items-center justify-center overflow-hidden relative z-10 border-4 border-white/20 shadow-2xl">
                            <span class="text-4xl font-black text-emerald-600">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <div class="absolute bottom-1 right-1 bg-emerald-500 border-4 border-emerald-700 w-8 h-8 rounded-full flex items-center justify-center z-20 shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-black tracking-tight">{{ Auth::user()->name }}</h2>
                    <p class="text-emerald-100 text-sm font-medium opacity-80">{{ Auth::user()->email }}</p>
                    
                    <div class="mt-5 flex gap-3">
                        <div class="px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full border border-white/10">
                            <span class="text-[10px] font-bold uppercase tracking-wider text-emerald-100">Member</span>
                        </div>
                        <div class="px-4 py-1.5 bg-emerald-900/30 backdrop-blur-md rounded-full border border-white/5">
                            <span class="text-[10px] font-bold text-emerald-200 font-mono">ID: {{ Auth::user()->id }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-xl mx-auto px-4 -mt-16 relative z-30 space-y-6">
            
            <div class="bg-white rounded-[2.5rem] shadow-xl shadow-slate-200/50 border border-slate-100 overflow-hidden">
                <div class="p-2">
                    <div class="space-y-1">
                        <button @click="openEdit = true" class="w-full flex items-center justify-between p-5 rounded-[2rem] hover:bg-slate-50 transition-all duration-300 group active:scale-[0.98]">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-blue-50 text-blue-500 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-slate-800 text-base group-hover:text-blue-600 transition">Edit Data Diri</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Nama & Email</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-blue-100 group-hover:text-blue-600 transition">
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-blue-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </button>

                        <button @click="openPassword = true" class="w-full flex items-center justify-between p-5 rounded-[2rem] hover:bg-slate-50 transition-all duration-300 group active:scale-[0.98]">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-purple-50 text-purple-500 rounded-2xl flex items-center justify-center group-hover:scale-110 group-hover:-rotate-3 transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-slate-800 text-base group-hover:text-purple-600 transition">Keamanan</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Ubah Password</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-purple-100 group-hover:text-purple-600 transition">
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-purple-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </div>
                        </button>

                        <a href="https://wa.me/6287714802071?text=Halo%20Admin%20Nusantaramu,%20saya%20butuh%20bantuan." target="_blank" class="w-full flex items-center justify-between p-5 rounded-[2rem] hover:bg-slate-50 transition-all duration-300 group active:scale-[0.98]">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-emerald-50 text-emerald-500 rounded-2xl flex items-center justify-center group-hover:scale-110 transition duration-300 shadow-sm">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                </div>
                                <div class="text-left">
                                    <p class="font-bold text-slate-800 text-base group-hover:text-emerald-600 transition">Pusat Bantuan</p>
                                    <p class="text-xs text-slate-400 mt-0.5">Hubungi via WhatsApp</p>
                                </div>
                            </div>
                            <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center group-hover:bg-emerald-100 group-hover:text-emerald-600 transition">
                                <svg class="w-4 h-4 text-slate-300 group-hover:text-emerald-600 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full py-4 bg-white border-2 border-rose-50 text-rose-500 rounded-[2rem] font-bold text-sm shadow-sm hover:bg-rose-50 hover:border-rose-100 hover:shadow-lg transition flex items-center justify-center gap-2 active:scale-[0.98]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Keluar Aplikasi
                </button>
            </form>
            
            <p class="text-center text-[10px] text-slate-400 font-medium pb-4 opacity-50">
                Nusantaramu App v1.2.0 &bull; Build 2026
            </p>
        </div>

        <div x-show="openEdit" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
            <div x-show="openEdit" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openEdit = false"></div>

            <div x-show="openEdit" 
                 x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-10"
                 class="bg-white rounded-[2.5rem] w-full max-w-sm shadow-2xl relative z-10 overflow-hidden">
                
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 p-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-black/10 rounded-full blur-xl -ml-10 -mb-10"></div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-4 border border-white/20 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    </div>
                    <h3 class="text-white font-black text-xl tracking-tight">Edit Data Diri</h3>
                    <p class="text-blue-100 text-xs font-medium mt-1">Perbarui informasi akun Anda</p>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    @method('PATCH')
                    
                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Nama Lengkap</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 pl-11 py-3 text-sm font-bold text-slate-700 transition-all" required>
                        </div>
                        @error('name', 'updateProfileInformation') <span class="text-xs text-rose-500 font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Email Address</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-slate-400 group-focus-within:text-blue-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 pl-11 py-3 text-sm font-bold text-slate-700 transition-all" required>
                        </div>
                        @error('email', 'updateProfileInformation') <span class="text-xs text-rose-500 font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-2 flex gap-3">
                        <button type="button" @click="openEdit = false" class="flex-1 py-3.5 bg-slate-100 text-slate-500 rounded-2xl font-bold text-sm hover:bg-slate-200 transition active:scale-95">Batal</button>
                        <button type="submit" class="flex-1 py-3.5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-2xl font-bold text-sm hover:shadow-lg hover:shadow-blue-500/30 transition active:scale-95">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div x-show="openPassword" class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
            <div x-show="openPassword" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0"
                 x-transition:enter-end="opacity-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100"
                 x-transition:leave-end="opacity-0"
                 class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="openPassword = false"></div>

            <div x-show="openPassword" 
                 x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-10"
                 class="bg-white rounded-[2.5rem] w-full max-w-sm shadow-2xl relative z-10 overflow-hidden">
                
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 p-8 text-center relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    <div class="absolute bottom-0 left-0 w-24 h-24 bg-black/10 rounded-full blur-xl -ml-10 -mb-10"></div>
                    <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center mx-auto mb-4 border border-white/20 shadow-lg">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                    </div>
                    <h3 class="text-white font-black text-xl tracking-tight">Keamanan</h3>
                    <p class="text-purple-100 text-xs font-medium mt-1">Lindungi akun dengan password kuat</p>
                </div>

                <form action="{{ route('password.update') }}" method="POST" class="p-8 space-y-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Password Saat Ini</label>
                        <input type="password" name="current_password" class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 px-4 py-3 text-sm font-bold text-slate-700 transition-all">
                        @error('current_password', 'updatePassword') <span class="text-xs text-rose-500 font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Password Baru</label>
                        <input type="password" name="password" class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 px-4 py-3 text-sm font-bold text-slate-700 transition-all">
                        @error('password', 'updatePassword') <span class="text-xs text-rose-500 font-bold mt-1 ml-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2 ml-1">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="w-full rounded-2xl border-slate-200 bg-slate-50 focus:bg-white focus:border-purple-500 focus:ring-4 focus:ring-purple-500/10 px-4 py-3 text-sm font-bold text-slate-700 transition-all">
                    </div>

                    <div class="pt-4 flex gap-3">
                        <button type="button" @click="openPassword = false" class="flex-1 py-3.5 bg-slate-100 text-slate-500 rounded-2xl font-bold text-sm hover:bg-slate-200 transition active:scale-95">Batal</button>
                        <button type="submit" class="flex-1 py-3.5 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-2xl font-bold text-sm hover:shadow-lg hover:shadow-purple-500/30 transition active:scale-95">Update</button>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>
</x-app-layout>