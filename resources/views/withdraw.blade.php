<x-app-layout>
    <x-slot name="title">Tarik Saldo</x-slot>
    <x-slot name="header"></x-slot>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        .glass-card-dark {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-entrance { animation: fade-in-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        [x-cloak] { display: none !important; }
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
                    <span class="font-bold text-white text-lg">Keuangan</span>
                </div>

                <div class="text-center text-white mb-6">
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight drop-shadow-md">Tarik Saldo</h1>
                    <p class="text-emerald-100 text-sm mt-2 max-w-lg mx-auto leading-relaxed">
                        Cairkan poin sampahmu menjadi saldo E-Wallet dengan mudah.
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-30 animate-entrance">
            
            @if(Auth::user()->role === 'admin')
            <div class="mb-8">
                <a href="{{ route('admin.withdraw.index') }}" class="relative block group overflow-hidden rounded-[2rem] shadow-xl border border-white/20">
                    <div class="absolute inset-0 bg-gradient-to-r from-orange-500 to-red-600 group-hover:scale-105 transition duration-500"></div>
                    <div class="relative p-6 flex justify-between items-center text-white">
                        <div class="flex items-center gap-4">
                            <div class="bg-white/20 p-3 rounded-full backdrop-blur-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Mode Admin</h3>
                                <p class="text-orange-100 text-xs">Kelola persetujuan penarikan member</p>
                            </div>
                        </div>
                        <div class="bg-white text-orange-600 px-4 py-2 rounded-xl font-bold text-sm shadow-md group-hover:bg-orange-50 transition">
                            Buka Panel >
                        </div>
                    </div>
                </a>
            </div>
            @endif

            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl shadow-lg shadow-emerald-500/10 flex items-center gap-4 animate-bounce-in mb-6">
                <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-emerald-900 text-sm">Berhasil!</p>
                    <p class="text-emerald-700 text-xs">{{ session('success') }}</p>
                </div>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-rose-50 border border-rose-100 p-4 rounded-2xl shadow-lg shadow-rose-500/10 flex items-center gap-4 animate-bounce-in mb-6">
                <div class="bg-rose-100 p-2.5 rounded-full text-rose-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-rose-900 text-sm">Gagal!</p>
                    <ul class="text-rose-700 text-xs list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="glass-card-dark rounded-[2.5rem] p-8 text-white shadow-2xl relative overflow-hidden flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-500/20 rounded-full blur-[80px] -mr-16 -mt-16"></div>
                        <div class="absolute bottom-0 left-0 w-40 h-40 bg-teal-500/10 rounded-full blur-[60px]"></div>
                        <img src="{{ asset('img/logo.png') }}" class="absolute -bottom-12 -right-12 w-56 h-56 opacity-[0.03] brightness-0 invert rotate-12 pointer-events-none" alt="Watermark">

                        <div class="relative z-10 text-left w-full">
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Saldo Bisa Ditarik</p>
                            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight">Rp {{ number_format(Auth::user()->wallet_balance, 0, ',', '.') }}</h2>
                            <p class="text-xs text-emerald-400 mt-2 font-bold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                Proses maks. 1x24 Jam
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100 relative">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="bg-emerald-100 p-2.5 rounded-xl text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Formulir Pencairan</h3>
                        </div>
                        
                        <form action="{{ route('withdraw.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-3">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Metode Pencairan</label>
                                    <div class="relative">
                                        <select name="payment_method" class="block w-full rounded-2xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500 focus:bg-white py-4 px-5 text-sm font-bold text-slate-700 transition shadow-sm appearance-none">
                                            <option value="GOPAY">GoPay</option>
                                            <option value="DANA">DANA</option>
                                            <option value="OVO">OVO</option>
                                            <option value="SHOPEEPAY">ShopeePay</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-slate-400">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div class="space-y-3">
                                    <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nominal (Min. 10.000)</label>
                                    <div class="relative group">
                                        <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                            <span class="text-emerald-600 font-black text-lg group-focus-within:text-emerald-500 transition">Rp</span>
                                        </div>
                                        <input type="number" name="amount" min="10000" 
                                               class="block w-full pl-14 pr-16 rounded-2xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500 focus:bg-white py-4 text-lg font-bold text-slate-800 placeholder-slate-300 transition shadow-sm" 
                                               placeholder="0" required>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nomor E-Wallet / Rekening</label>
                                <input type="number" name="account_number" 
                                       class="block w-full rounded-2xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500 focus:bg-white py-4 px-5 text-sm font-bold text-slate-800 placeholder-slate-300 transition shadow-sm" 
                                       placeholder="Contoh: 081234567890" required>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:to-teal-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-emerald-500/30 hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition duration-300 flex items-center justify-center gap-2 group">
                                <span>Ajukan Penarikan</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden flex flex-col h-full min-h-[400px]">
                        <div class="p-8 border-b border-slate-50 bg-slate-50/50 flex items-center justify-between">
                            <h3 class="font-bold text-slate-800 flex items-center gap-3">
                                <span class="bg-white p-2 rounded-xl border border-slate-100 shadow-sm text-emerald-600">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                Riwayat Penarikan
                            </h3>
                        </div>
                        
                        <div class="divide-y divide-slate-50 overflow-y-auto max-h-[600px] p-2">
                            @forelse($withdrawals ?? [] as $item)
                            <div class="p-5 hover:bg-slate-50 transition rounded-2xl group cursor-default">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-slate-100 p-2.5 rounded-xl text-slate-600 group-hover:bg-white group-hover:shadow-sm border border-slate-100 transition">
                                            @if($item->payment_method == 'DANA') 
                                                <span class="font-black text-blue-500 text-[10px] tracking-tighter">DANA</span>
                                            @elseif($item->payment_method == 'GOPAY')
                                                <span class="font-black text-green-500 text-[10px] tracking-tighter">GOPAY</span>
                                            @elseif($item->payment_method == 'OVO')
                                                <span class="font-black text-purple-500 text-[10px] tracking-tighter">OVO</span>
                                            @else
                                                <span class="font-black text-orange-500 text-[10px] tracking-tighter">SPAY</span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-bold text-slate-800 text-sm font-mono tracking-tight">{{ $item->account_number }}</p>
                                            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider border
                                        {{ $item->status == 'completed' ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : 
                                          ($item->status == 'pending' ? 'bg-amber-100 text-amber-700 border-amber-200' : 'bg-rose-100 text-rose-700 border-rose-200') }}">
                                        {{ $item->status == 'completed' ? 'Sukses' : ($item->status == 'pending' ? 'Proses' : 'Gagal') }}
                                    </span>
                                </div>
                                <div class="flex justify-between items-end border-t border-slate-100 pt-3 mt-3">
                                    <p class="text-xs text-slate-400">Total Cair</p>
                                    <p class="text-sm font-black text-slate-800">- Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @empty
                            <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                                <div class="bg-slate-50 p-6 rounded-full mb-4 text-slate-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                                </div>
                                <p class="text-slate-800 font-bold text-sm">Belum ada penarikan.</p>
                                <p class="text-slate-400 text-xs mt-1 leading-relaxed">Saldo yang Anda tarik akan muncul riwayatnya di sini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>
</x-app-layout>