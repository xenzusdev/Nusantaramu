<div class="fixed bottom-0 left-0 w-full bg-white/90 backdrop-blur-lg border-t border-slate-200 pb-safe z-50 md:hidden safe-area-bottom shadow-[0_-5px_20px_rgba(0,0,0,0.03)]">
    <div class="grid grid-cols-4 h-16">
        
        <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('dashboard') ? 'text-emerald-600' : 'text-slate-400 hover:text-emerald-600' }} transition relative">
            @if(request()->routeIs('dashboard'))
            <div class="absolute top-0 w-10 h-1 bg-emerald-500 rounded-b-full"></div>
            @endif
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
            <span class="text-[10px] font-medium">Home</span>
        </a>

        <a href="{{ route('setor.index') }}" class="flex flex-col items-center justify-center {{ request()->routeIs('setor.index') ? 'text-emerald-600' : 'text-slate-400 hover:text-emerald-600' }} transition">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            <span class="text-[10px] font-medium">Setor</span>
        </a>

        <a href="{{ url('/history') }}" class="flex flex-col items-center justify-center {{ request()->is('history*') ? 'text-emerald-600' : 'text-slate-400 hover:text-emerald-600' }} transition">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            <span class="text-[10px] font-medium">Riwayat</span>
        </a>

        <a href="{{ url('/profile') }}" class="flex flex-col items-center justify-center {{ request()->is('profile*') ? 'text-emerald-600' : 'text-slate-400 hover:text-emerald-600' }} transition">
            <svg class="w-6 h-6 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
            <span class="text-[10px] font-medium">Akun</span>
        </a>

    </div>
</div>