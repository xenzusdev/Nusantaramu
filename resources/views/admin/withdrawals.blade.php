<x-app-layout>
    <x-slot name="title">Admin - Approval Penarikan</x-slot>
    <x-slot name="header"></x-slot>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        .glass-card { background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.5); }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-slate-900/10">
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800 via-slate-700 to-slate-900"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/5 rounded-full blur-[120px] animate-pulse"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-4 sm:px-8">
                <div class="relative flex items-center justify-center mb-8">
                    <a href="{{ route('dashboard') }}" class="absolute left-0 flex items-center gap-2 text-white/60 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span class="text-sm font-bold">Dashboard</span>
                    </a>
                    <span class="font-bold text-white text-lg tracking-wide">Admin Panel</span>
                </div>

                <div class="text-center text-white mb-6">
                    <h1 class="text-3xl font-black tracking-tight">Permintaan Penarikan</h1>
                    <p class="text-slate-300 text-sm mt-1">Kelola pencairan dana user</p>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 -mt-24 relative z-30">
            
            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 text-emerald-700 px-4 py-3 rounded-2xl mb-6 flex items-center gap-3 shadow-lg shadow-emerald-500/10" x-data="{show: true}" x-show="show" x-init="setTimeout(() => show = false, 3000)">
                <div class="bg-emerald-100 p-1.5 rounded-full"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg></div>
                <span class="font-bold text-sm">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($withdrawals as $item)
                <div class="bg-white rounded-[2.5rem] p-6 shadow-xl border border-slate-100 relative overflow-hidden group hover:shadow-2xl transition duration-300">
                    <div class="absolute top-0 right-0 bg-orange-50 px-4 py-2 rounded-bl-2xl border-l border-b border-orange-100">
                        <span class="text-[10px] font-black uppercase tracking-wider text-orange-500">Menunggu</span>
                    </div>

                    <div class="flex items-center gap-4 mb-5">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center font-black text-slate-500 text-lg border border-slate-200">
                            {{ substr($item->user->name, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-800">{{ $item->user->name }}</h3>
                            <p class="text-xs text-slate-400 font-mono">{{ $item->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-slate-400 font-bold uppercase">Metode</span>
                            <span class="text-xs font-bold text-slate-700 px-2 py-1 bg-white rounded border border-slate-200">{{ strtoupper($item->bank_name ?? 'E-Wallet') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-slate-400 font-bold uppercase">Nomor</span>
                            <span class="text-sm font-mono font-medium text-slate-600 select-all">{{ $item->account_number }}</span>
                        </div>
                        <div class="border-t border-slate-200 my-2 border-dashed"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-400 font-bold uppercase">Jumlah</span>
                            <span class="text-xl font-black text-slate-800">Rp {{ number_format($item->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <form action="{{ route('admin.withdraw.reject', $item->id) }}" method="POST" onsubmit="return confirm('Yakin tolak? Saldo akan dikembalikan ke user.')">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-rose-50 text-rose-600 rounded-xl font-bold text-sm hover:bg-rose-100 hover:text-rose-700 transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Tolak
                            </button>
                        </form>
                        
                        <form action="{{ route('admin.withdraw.approve', $item->id) }}" method="POST" onsubmit="return confirm('Setujui pencairan dana ini?')">
                            @csrf
                            <button type="submit" class="w-full py-3 bg-emerald-500 text-white rounded-xl font-bold text-sm hover:bg-emerald-600 hover:shadow-lg hover:shadow-emerald-500/30 transition flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Transfer
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-1 md:col-span-2 text-center py-20 bg-white rounded-[2.5rem] shadow-sm border border-slate-100">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 text-slate-300">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-800 text-lg">Semua Bersih!</h3>
                    <p class="text-slate-400 text-sm">Tidak ada permintaan penarikan pending.</p>
                </div>
                @endforelse
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>
</x-app-layout>