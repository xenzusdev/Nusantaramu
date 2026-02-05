<div class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-lg border-t border-slate-200 pb-safe z-50 md:hidden safe-area-bottom shadow-[0_-5px_20px_rgba(0,0,0,0.03)]">
    <div class="grid grid-cols-4 h-16">
        
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center transition group">
            <div class="relative p-1">
                @if(request()->routeIs('dashboard'))
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-emerald-500 rounded-b-full shadow-[0_2px_8px_rgba(16,185,129,0.4)]"></div>
                @endif
                <svg class="w-6 h-6 mb-0.5 {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}">Home</span>
        </a>

        <a href="{{ route('simulation') }}" class="flex flex-col items-center justify-center transition group">
            <div class="relative p-1">
                @if(request()->routeIs('simulation'))
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-emerald-500 rounded-b-full shadow-[0_2px_8px_rgba(16,185,129,0.4)]"></div>
                @endif
                <svg class="w-6 h-6 mb-0.5 {{ request()->routeIs('simulation') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->routeIs('simulation') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}">Setor</span>
        </a>

        <a href="{{ url('/history') }}" class="flex flex-col items-center justify-center transition group">
            <div class="relative p-1">
                @if(request()->is('history*'))
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-emerald-500 rounded-b-full shadow-[0_2px_8px_rgba(16,185,129,0.4)]"></div>
                @endif
                <svg class="w-6 h-6 mb-0.5 {{ request()->is('history*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->is('history*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}">Riwayat</span>
        </a>

        <a href="{{ url('/profile') }}" class="flex flex-col items-center justify-center transition group">
            <div class="relative p-1">
                @if(request()->is('profile*'))
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-8 h-1 bg-emerald-500 rounded-b-full shadow-[0_2px_8px_rgba(16,185,129,0.4)]"></div>
                @endif
                <svg class="w-6 h-6 mb-0.5 {{ request()->is('profile*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <span class="text-[10px] font-bold {{ request()->is('profile*') ? 'text-emerald-600' : 'text-slate-400 group-hover:text-emerald-600' }}">Akun</span>
        </a>

    </div>
</div>