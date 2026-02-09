<x-app-layout>
    <x-slot name="title">Riwayat Transaksi</x-slot>
    <x-slot name="header"></x-slot>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .glass-card-dark {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-300/20 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale" alt="Pattern">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-4 sm:px-8">
                <div class="relative flex items-center justify-center mb-8">
                    <a href="{{ route('dashboard') }}" class="absolute left-0 flex items-center gap-2 text-white/80 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="text-sm font-bold">Dashboard</span>
                </a>
    
                    <span class="font-bold text-white text-lg">Riwayat</span>
                </div>

                <div class="text-center text-white mb-6">
                    <h1 class="text-3xl font-extrabold tracking-tight drop-shadow-md">Aktivitas Saya</h1>
                    <p class="text-emerald-100 text-sm mt-1">Jejak kontribusi Anda untuk lingkungan.</p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-30">
            
            <div class="grid grid-cols-2 gap-4 mb-8">
                <div class="bg-white p-6 rounded-3xl shadow-lg border border-emerald-100 flex flex-col items-center justify-center text-center">
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800">{{ number_format($totalPoints) }}</span>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Poin</span>
                </div>
                <div class="bg-white p-6 rounded-3xl shadow-lg border border-emerald-100 flex flex-col items-center justify-center text-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-full flex items-center justify-center text-teal-600 mb-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path></svg>
                    </div>
                    <span class="text-2xl font-black text-slate-800">{{ number_format($totalWeight, 1) }}</span>
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Kg / Unit</span>
                </div>
            </div>

            <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden min-h-[400px]">
                <div class="p-8 border-b border-slate-50 bg-slate-50/50 backdrop-blur-sm sticky top-0 z-10">
                    <h3 class="font-bold text-slate-800 text-lg">Semua Transaksi</h3>
                </div>
                
                <div class="divide-y divide-slate-50">
                    @forelse($transactions as $trx)
                    <div class="p-6 hover:bg-slate-50 transition flex items-center justify-between group">
                        <div class="flex items-center gap-5">
                            <div class="{{ $trx->waste_type == 'organic' ? 'bg-orange-50 text-orange-600' : 'bg-blue-50 text-blue-600' }} p-4 rounded-2xl shadow-sm transition group-hover:scale-110">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    @if($trx->waste_type == 'organic')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                    @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    @endif
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 text-base capitalize">{{ $trx->waste_type == 'organic' ? 'Sampah Organik' : 'Botol/Plastik' }}</p>
                                <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 mt-1">
                                    <span class="text-xs text-slate-400 font-medium">{{ $trx->created_at->isoFormat('D MMMM Y, HH:mm') }}</span>
                                    <span class="hidden sm:block text-slate-300">•</span>
                                    <span class="text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded border border-slate-200 w-fit font-mono">{{ $trx->device_code }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-emerald-600 text-lg">+{{ number_format($trx->points_earned) }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-0.5 bg-slate-100 inline-block px-2.5 py-1 rounded-lg border border-slate-200">
                                {{ $trx->amount }} {{ $trx->waste_type == 'organic' ? 'Kg' : 'Pcs' }}
                            </p>
                        </div>
                    </div>
                    @empty
                    <div class="py-20 text-center flex flex-col items-center">
                        <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">Belum ada riwayat</p>
                        <p class="text-xs text-slate-400">Transaksi Anda akan muncul di sini.</p>
                    </div>
                    @endforelse
                </div>

                @if($transactions->hasPages())
                <div class="p-6 border-t border-slate-50 bg-slate-50">
                    {{ $transactions->links() }}
                </div>
                @endif
            </div>

        </div>

        @include('layouts.partials.mobile-nav')

    </div>
</x-app-layout>