<x-app-layout>
    <x-slot name="title">Web App - Nusantaramu</x-slot>
    <x-slot name="header"></x-slot>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    
    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        .glass-panel {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.05);
        }
        .glass-card-dark {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        @keyframes float-y {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-6px); }
        }
        .animate-float { animation: float-y 5s ease-in-out infinite; }
        @keyframes pulse-glow {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.6); }
            70% { box-shadow: 0 0 0 12px rgba(16, 185, 129, 0); }
            100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .ring-pulse { animation: pulse-glow 2s infinite; }
        @keyframes progress-load { from { width: 0%; } }
        .animate-progress { animation: progress-load 1.5s ease-out forwards; }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        [x-cloak] { display: none !important; }
        .header-stack { position: relative; z-index: 40; }
        .content-stack { position: relative; z-index: 30; }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" x-data="dashboardLogic()">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-300/20 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale" alt="Pattern">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-4 sm:px-8">
                <div class="flex justify-between items-center">
                    <div class="text-white">
                        <p class="text-emerald-100 text-xs font-bold tracking-widest uppercase mb-1 flex items-center gap-2">
                            <span x-text="greeting">Selamat Pagi</span>
                            <span class="bg-white/20 px-2 py-0.5 rounded-full text-[9px] backdrop-blur-sm border border-white/10">Member</span>
                        </p>
                        <h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-white drop-shadow-md">
                            {{ Auth::user()->name }}
                        </h1>
                    </div>

                    <div class="flex items-center gap-3">
                        
                        <div x-data="{ open: false }">
                        <button @click="open = true" class="relative p-3 bg-white/20 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/30 transition focus:outline-none group shadow-lg ring-pulse">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span class="absolute top-2.5 right-3 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-emerald-500 animate-ping"></span>
                            <span class="absolute top-2.5 right-3 w-2.5 h-2.5 bg-rose-500 rounded-full border-2 border-emerald-500"></span>
                        @endif
                    </button>

                    <div x-show="open" 
                        style="display: none;"
                        class="fixed inset-0 z-[999] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">

                        <div @click.away="open = false"
                            class="bg-white w-full max-w-sm rounded-[2.5rem] shadow-2xl overflow-hidden relative"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 scale-90 translate-y-10"
                            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                            x-transition:leave-end="opacity-0 scale-90 translate-y-10">
            
                        <div class="px-6 py-5 bg-slate-50 border-b border-slate-100 flex justify-between items-center">
                            <h3 class="text-lg font-bold text-slate-800">Notifikasi</h3>
                            <div class="flex items-center gap-3">
                                @if(Auth::user()->unreadNotifications->count() > 0)
                                <form action="{{ route('notifications.markRead') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] bg-emerald-100 text-emerald-700 px-3 py-1.5 rounded-full font-bold hover:bg-emerald-200 transition">
                                        Baca Semua
                                    </button>
                                </form>
                                @endif
                                <button @click="open = false" class="bg-slate-200 p-1.5 rounded-full text-slate-500 hover:bg-slate-300 transition">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                            </div>
                        </div>

                    <div class="max-h-[400px] overflow-y-auto bg-white custom-scrollbar">
                        @forelse(Auth::user()->notifications as $notification)
                        <a href="{{ $notification->data['link'] ?? '#' }}" class="block px-6 py-5 hover:bg-slate-50 transition border-b border-slate-50 last:border-0 {{ $notification->read_at ? 'opacity-60' : 'bg-emerald-50/30' }}">
                            <div class="flex gap-4">
                                <div class="flex-shrink-0 mt-1">
                                    @if(($notification->data['type'] ?? '') == 'success')
                                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </div>
                                    @else
                                        <div class="w-10 h-10 bg-rose-100 rounded-full flex items-center justify-center text-rose-600 shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-slate-800">{{ $notification->data['title'] ?? 'Info' }}</p>
                                    <p class="text-xs text-slate-500 mt-1 leading-relaxed line-clamp-2">{{ $notification->data['message'] ?? '' }}</p>
                                    <p class="text-[10px] text-slate-400 mt-2 font-medium flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        {{ $notification->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="px-6 py-16 text-center flex flex-col items-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4 border border-slate-100">
                                <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            </div>
                            <p class="text-slate-800 font-bold text-base">Tidak ada notifikasi</p>
                            <p class="text-slate-400 text-xs mt-1">Belum ada aktivitas terbaru saat ini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="relative p-3 bg-white/20 backdrop-blur-md border border-white/20 rounded-full hover:bg-white/30 transition focus:outline-none group shadow-lg">
                                <svg class="w-6 h-6 text-white transition-transform duration-300" :class="{'rotate-90': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                                </svg>
                            </button>

                            <div x-show="open" 
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                                 class="absolute right-0 mt-4 w-56 bg-white rounded-2xl shadow-2xl ring-1 ring-black/5 overflow-hidden origin-top-right transform z-[9999]" style="z-index: 9999;">
                                
                                <div class="px-5 py-3 bg-slate-50 border-b border-slate-100">
                                    <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">Menu Cepat</p>
                                </div>

                                <div class="py-1">
                                    <a href="{{ route('dashboard') }}" class="block px-5 py-3 text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Dashboard</a>
                                    <a href="{{ url('/history') }}" class="block px-5 py-3 text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Riwayat</a>
                                    <a href="{{ url('/profile') }}" class="block px-5 py-3 text-sm font-medium text-slate-600 hover:bg-emerald-50 hover:text-emerald-600 transition">Profile</a>
                                    <a href="{{ route('simulation') }}" class="block px-5 py-3 text-sm font-bold text-orange-500 hover:bg-orange-50 transition border-t border-slate-50">Mode Darurat</a>
                                    
                                    <form method="POST" action="{{ route('logout') }}" class="border-t border-slate-50">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-5 py-3 text-sm font-medium text-rose-500 hover:bg-rose-50 transition">Logout</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 lg:-mt-36 relative z-30 space-y-8">
            
            @if(session('connected_device'))
            <div class="glass-panel p-4 rounded-xl shadow-lg flex justify-between items-center animate-float bg-white/95 border-l-4 border-emerald-500">
                <div class="flex items-center gap-4">
                    <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-600 shadow-sm animate-pulse">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-slate-800 text-sm">Perangkat Terhubung</p>
                        <p class="text-xs text-slate-500">ID: <span class="font-mono font-bold text-emerald-600">{{ session('connected_device') }}</span></p>
                    </div>
                </div>
                <div class="flex h-3 w-3 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                
                <div class="lg:col-span-1 h-full">
                    <div class="glass-card-dark rounded-[2.5rem] p-8 text-white shadow-2xl shadow-emerald-900/20 relative group transition-all duration-500 hover:shadow-emerald-900/40 flex flex-col justify-between min-h-[420px]">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/30 rounded-full blur-[100px] -mr-20 -mt-20 group-hover:bg-emerald-500/40 transition duration-700"></div>
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-teal-500/20 rounded-full blur-[80px] -ml-10 -mb-10"></div>
                        <img src="{{ asset('img/logo.png') }}" class="absolute -bottom-12 -right-12 w-56 h-56 opacity-[0.03] brightness-0 invert pointer-events-none rotate-12" alt="Watermark">

                        <div class="relative z-10">
                            <div class="flex justify-between items-start mb-8">
                                <div class="p-3 bg-white/10 backdrop-blur-md rounded-2xl border border-white/10 shadow-inner">
                                    <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                                <div class="bg-emerald-500/20 px-3 py-1.5 rounded-full border border-emerald-500/30 backdrop-blur-sm">
                                    <p class="text-[10px] font-bold text-emerald-300 uppercase tracking-wider flex items-center gap-1">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span> Active
                                    </p>
                                </div>
                            </div>

                            <div class="mb-8">
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-1.5">Total Poin Saya</p>
                                <h2 class="text-5xl lg:text-6xl font-black tracking-tight text-white leading-none drop-shadow-xl">{{ number_format($user->points_balance) }}</h2>
                                <p class="text-emerald-200 text-sm mt-2 font-medium tracking-wide">Estimasi: Rp {{ number_format($estimatedRupiah, 0, ',', '.') }}</p>
                            </div>

                            <div class="bg-white/5 p-5 rounded-2xl border border-white/10 backdrop-blur-md">
                                <div class="flex justify-between text-sm mb-2">
                                    <span class="text-slate-400 font-medium text-xs">Saldo Dompet (IDR)</span>
                                    <span class="text-emerald-300 font-bold text-lg">Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}</span>
                                </div>
                                @php
                                    $minWithdraw = 10000;
                                    $currentBalance = $user->wallet_balance;
                                    $percentage = min(($currentBalance / $minWithdraw) * 100, 100);
                                @endphp
                                <div class="w-full bg-slate-700/50 h-2.5 rounded-full overflow-hidden border border-white/5">
                                    <div class="bg-gradient-to-r from-emerald-400 to-teal-300 h-full rounded-full shadow-[0_0_15px_#34d399] animate-progress" style="width: {{ $percentage }}%"></div>
                                </div>
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-[10px] text-slate-400">Target Min. Rp 10.000</p>
                                    <p class="text-[10px] text-emerald-400 font-bold">{{ round($percentage) }}%</p>
                                </div>
                            </div>
                        </div>

                        <div class="relative z-10 grid grid-cols-2 gap-4 mt-8">
                            <button @click="openModal('withdraw')" class="bg-emerald-500 hover:bg-emerald-400 text-white py-4 rounded-2xl font-bold text-center text-sm transition shadow-lg shadow-emerald-900/40 flex flex-col items-center justify-center gap-1 group/btn border border-emerald-400/50">
                                <svg class="w-5 h-5 group-hover/btn:-translate-y-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                Tukar
                            </button>
                            <a href="{{ url('/history') }}" class="bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white py-4 rounded-2xl font-bold text-center text-sm transition border border-white/10 flex flex-col items-center justify-center gap-1 backdrop-blur-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Riwayat
                            </a>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <div class="flex flex-col gap-6">
                        <a href="{{ route('setor.index') }}" class="group bg-white p-7 rounded-[2.5rem] shadow-sm border border-slate-100 hover:border-emerald-300 hover:shadow-xl hover:shadow-emerald-100/30 transition-all duration-300 flex flex-col justify-between h-[190px] relative overflow-hidden text-left w-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <div class="flex justify-between items-start relative z-10 w-full">
                                <div class="bg-emerald-100 p-4 rounded-3xl text-emerald-600 group-hover:scale-110 group-hover:rotate-6 transition duration-300 shadow-sm border border-emerald-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </div>
                                <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-300 group-hover:bg-emerald-500 group-hover:text-white group-hover:border-emerald-500 transition shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                            <div class="relative z-10">
                                <h4 class="font-bold text-slate-900 text-xl group-hover:text-emerald-700 transition">Setor Sampah</h4>
                                <p class="text-sm text-slate-500 mt-1 group-hover:text-slate-600">Scan QR & mulai menabung</p>
                            </div>
                        </a>

                        <button @click="openModal('sedekah')" class="group bg-white p-7 rounded-[2.5rem] shadow-sm border border-slate-100 hover:border-teal-300 hover:shadow-xl hover:shadow-teal-100/30 transition-all duration-300 flex flex-col justify-between h-[190px] relative overflow-hidden text-left w-full">
                            <div class="absolute inset-0 bg-gradient-to-br from-teal-50/80 to-transparent opacity-0 group-hover:opacity-100 transition duration-500"></div>
                            <div class="flex justify-between items-start relative z-10 w-full">
                                <div class="bg-teal-100 p-4 rounded-3xl text-teal-600 group-hover:scale-110 group-hover:-rotate-6 transition duration-300 shadow-sm border border-teal-200">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <div class="w-10 h-10 rounded-full border border-slate-200 flex items-center justify-center text-slate-300 group-hover:bg-teal-500 group-hover:text-white group-hover:border-teal-500 transition shadow-sm">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                            <div class="relative z-10">
                                <h4 class="font-bold text-slate-900 text-xl group-hover:text-teal-700 transition">Sedekah</h4>
                                <p class="text-sm text-slate-500 mt-1 group-hover:text-slate-600">Ubah poin jadi amal jariyah</p>
                            </div>
                        </button>
                    </div>

                    <div class="flex flex-col gap-6">
                        <div class="bg-white p-7 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between h-[190px] hover:shadow-lg transition duration-300 relative overflow-hidden">
                            <div class="absolute -right-5 -top-5 w-32 h-32 bg-blue-50 rounded-full blur-2xl opacity-60"></div>
                            <div class="flex justify-between items-start relative z-10">
                                <div class="bg-blue-50 p-4 rounded-3xl text-blue-600 shadow-sm border border-blue-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                            <div class="text-left relative z-10">
                                <h4 class="text-4xl font-black text-slate-900">{{ $totalAnorganic }}</h4>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-1">Item Plastik</p>
                            </div>
                        </div>

                        <div class="bg-white p-7 rounded-[2.5rem] shadow-sm border border-slate-100 flex flex-col justify-between h-[190px] hover:shadow-lg transition duration-300 relative overflow-hidden">
                            <div class="absolute -right-5 -top-5 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60"></div>
                            <div class="flex justify-between items-start relative z-10">
                                <div class="bg-orange-50 p-4 rounded-3xl text-orange-600 shadow-sm border border-orange-100">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="text-left relative z-10">
                                <h4 class="text-4xl font-black text-slate-900">{{ $totalOrganic }} <span class="text-sm text-slate-400 font-bold">Kg</span></h4>
                                <p class="text-[11px] text-slate-400 font-bold uppercase tracking-widest mt-1">Sampah Organik</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100 mt-8 relative overflow-hidden">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <h3 class="font-bold text-slate-800 text-lg">Analitik Setoran</h3>
                        <p class="text-xs text-slate-500">Performa kontribusi minggu ini</p>
                    </div>
                    <div class="flex items-center gap-2 bg-slate-50 p-1 rounded-xl border border-slate-200">
                        <button class="px-4 py-1.5 rounded-lg bg-white text-xs font-bold text-slate-800 shadow-sm border border-slate-100">7 Hari</button>
                    </div>
                </div>
                <div class="h-80 w-full">
                    <canvas id="wasteChart"></canvas>
                </div>
            </div>

            <div id="riwayat" class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden mb-10">
                <div class="p-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-2.5 rounded-xl shadow-sm border border-slate-100 text-emerald-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="font-bold text-slate-800 text-lg">Riwayat Terakhir</h3>
                    </div>
                    <a href="{{ url('/history') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline transition uppercase tracking-wide">Lihat Semua</a>
                </div>
                
                <div class="divide-y divide-slate-50">
                    @forelse($transactions as $trx)
                    <div class="p-6 hover:bg-slate-50 transition flex items-center justify-between group cursor-pointer">
                        <div class="flex items-center gap-5">
                            <div class="{{ $trx->waste_type == 'organic' ? 'bg-orange-50 text-orange-600' : 'bg-blue-50 text-blue-600' }} p-4 rounded-2xl group-hover:scale-110 transition duration-300 shadow-sm">
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
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="px-2.5 py-0.5 rounded-md bg-slate-100 text-[10px] font-bold text-slate-500 uppercase tracking-wide border border-slate-200">{{ $trx->device_code }}</span>
                                    <span class="text-xs text-slate-400 font-medium">• {{ $trx->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-black text-emerald-600 text-lg">+{{ number_format($trx->points_earned) }}</p>
                            <p class="text-xs text-slate-400 font-medium mt-0.5 bg-slate-100 inline-block px-2.5 py-1 rounded-lg border border-slate-200">{{ $trx->amount }} {{ $trx->waste_type == 'organic' ? 'Kg' : 'Pcs' }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-16 text-center flex flex-col items-center">
                        <div class="inline-block p-5 bg-slate-50 rounded-full mb-4 text-slate-300 shadow-inner">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 00-2-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <p class="text-slate-500 font-bold mb-1">Belum ada riwayat transaksi</p>
                        <p class="text-xs text-slate-400 mb-6 max-w-xs mx-auto leading-relaxed">Mulai setor sampahmu sekarang untuk melihat riwayat penukaran poin di sini.</p>
                        <a href="{{ route('setor.index') }}" class="px-8 py-3 rounded-xl bg-emerald-600 text-white text-xs font-bold hover:bg-emerald-700 transition shadow-lg shadow-emerald-500/20 inline-flex items-center gap-2">
                            Mulai Setor
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div x-show="modals.sedekah" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-md" x-cloak x-transition.opacity>
            <div class="bg-white rounded-[2.5rem] w-full max-w-sm overflow-hidden shadow-2xl relative border border-white/20" @click.outside="modals.sedekah = false">
                <div class="bg-teal-500 p-8 text-center relative">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 text-teal-600 shadow-xl animate-float">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                    </div>
                    <h3 class="text-white font-bold text-2xl">Sedekah Sampah</h3>
                    <p class="text-teal-50 text-sm mt-1">Salurkan poinmu untuk kebaikan</p>
                </div>
                <div class="p-8">
                    <div class="bg-teal-50 border border-teal-100 p-4 rounded-xl mb-6">
                        <p class="text-teal-800 text-sm text-center leading-relaxed font-medium">Poin Anda akan dikonversi menjadi dana tunai dan disalurkan melalui <strong>Lazismu</strong>.</p>
                    </div>
                    <a href="{{ route('donation.index') }}" class="block w-full py-4 bg-teal-600 text-white rounded-xl font-bold text-sm text-center hover:bg-teal-700 transition shadow-lg shadow-teal-500/30">Lanjut Sedekah</a>
                    <button @click="modals.sedekah = false" class="mt-4 w-full py-3 text-slate-400 text-xs font-bold hover:text-slate-600">Nanti Saja</button>
                </div>
            </div>
        </div>

        <div x-show="modals.withdraw" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-md" x-cloak x-transition.opacity>
            <div class="bg-white rounded-[2.5rem] w-full max-w-sm overflow-hidden shadow-2xl relative border border-white/20" @click.outside="modals.withdraw = false">
                <div class="p-8">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-xl font-bold text-slate-900">Tarik Saldo</h3>
                        <button @click="modals.withdraw = false" class="text-slate-400 hover:text-slate-600"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                    <div class="bg-emerald-50 p-5 rounded-2xl mb-6 border border-emerald-100 flex justify-between items-center">
                        <span class="text-sm text-emerald-600 font-bold">Saldo Tersedia</span>
                        <span class="text-lg font-black text-emerald-700">Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}</span>
                    </div>
                    <div class="space-y-3">
                        <button class="w-full flex items-center gap-4 p-4 border border-slate-100 rounded-2xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="w-10 h-10 bg-white border border-slate-100 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                <img src="{{ asset('img/gopay.png') }}" alt="GoPay" class="w-6 h-6 object-contain">
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-slate-800 text-sm">GoPay</p>
                                <p class="text--[10px] text-slate-400">Min. Rp 10.000</p>
                            </div>
                        </button>
                        <button class="w-full flex items-center gap-4 p-4 border border-slate-100 rounded-2xl hover:border-blue-500 hover:bg-blue-50 transition group">
                            <div class="w-10 h-10 bg-white border border-slate-100 rounded-full flex items-center justify-center group-hover:scale-110 transition">
                                <img src="{{ asset('img/dana.png') }}" alt="Dana" class="w-6 h-6 object-contain">
                            </div>
                            <div class="text-left">
                                <p class="font-bold text-slate-800 text-sm">Dana</p>
                                <p class="text--[10px] text-slate-400">Min. Rp 10.000</p>
                            </div>
                        </button>
                    </div>
                    <a href="{{ route('withdraw.index') }}" class="block mt-8 w-full py-4 bg-slate-900 text-white rounded-xl font-bold text-sm text-center hover:bg-slate-800 transition shadow-lg">Lanjut Penarikan</a>
                </div>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>

    <script>
        function dashboardLogic() {
            return {
                greeting: '',
                modals: { withdraw: false, sedekah: false },
                init() {
                    this.setGreeting();
                    this.initChart();
                },
                openModal(type) {
                    if (type === 'setor') {
                        window.location.href = "{{ route('setor.index') }}";
                    } else {
                        this.modals[type] = true;
                    }
                },
                setGreeting() {
                    const h = new Date().getHours();
                    this.greeting = h < 12 ? 'Selamat Pagi' : h < 15 ? 'Selamat Siang' : h < 18 ? 'Selamat Sore' : 'Selamat Malam';
                },
                initChart() {
                    const ctx = document.getElementById('wasteChart');
                    if(ctx) {
                        let gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
                        gradient.addColorStop(0, 'rgba(16, 185, 129, 0.8)'); 
                        gradient.addColorStop(1, 'rgba(16, 185, 129, 0.2)');

                        const labels = @json($chartLabels);
                        const data = @json($chartData);

                        new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Sampah (Kg)',
                                    data: data, 
                                    backgroundColor: gradient,
                                    borderRadius: 10,
                                    barThickness: 12,
                                    hoverBackgroundColor: '#059669'
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: { legend: { display: false } },
                                scales: {
                                    y: { display: false },
                                    x: { grid: { display: false } }
                                }
                            }
                        });
                    }
                }
            }
        }
    </script>
</x-app-layout>