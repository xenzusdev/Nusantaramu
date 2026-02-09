<div class="bg-white/80 backdrop-blur-md sticky top-0 z-[100] border-b border-slate-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center text-white shadow-sm">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-5 h-5 object-contain brightness-0 invert">
                </div>
                <span class="font-bold text-xl tracking-tight text-slate-800">Nusantaramu</span>
            </div>

            <div class="flex items-center gap-4">
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open" class="flex items-center gap-2 text-sm font-bold text-slate-600 hover:text-emerald-600 transition focus:outline-none">
                        <span>Menu</span>
                        <svg class="w-4 h-4 transition-transform duration-200" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>

                    <div x-show="open" 
                         @click.away="open = false"
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-75"
                         x-transition:leave-start="transform opacity-100 scale-100"
                         x-transition:leave-end="transform opacity-0 scale-95"
                         class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-xl border border-slate-100 py-1 overflow-hidden origin-top-right">
                        
                        <div class="px-4 py-3 border-b border-slate-50 bg-slate-50/50">
                            <p class="text-xs text-slate-500">Halo,</p>
                            <p class="text-sm font-bold text-slate-800 truncate">{{ Auth::user()->name }}</p>
                        </div>
                        
                        <a href="{{ route('dashboard') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Dashboard</a>
                        <a href="{{ url('/history') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Riwayat</a>
                        <a href="{{ url('/profile') }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Profile</a>
                        
                        <a href="{{ route('simulation') }}" class="block px-4 py-2 text-sm text-orange-500 hover:bg-orange-50 transition font-medium border-t border-slate-50">
                            Mode Darurat (Simulasi)
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-50 mt-1">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-rose-500 hover:bg-rose-50 transition font-medium">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>