<x-app-layout>
    <x-slot name="title">Mode Simulasi</x-slot>
    <x-slot name="header"></x-slot>

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
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" x-data="{ wasteType: 'anorganic' }">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-300/20 rounded-full blur-[100px] translate-x-1/3 translate-y-1/3"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale" alt="Pattern">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-4 sm:px-8">
                <div class="relative flex items-center justify-center mb-6">
                    <a href="{{ route('dashboard') }}" class="absolute left-0 flex items-center gap-2 text-white/80 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="text-sm font-bold">Kembali</span>
                </a>
    
                    <span class="font-bold text-white text-lg">Mode Simulasi</span>
                </div>

                <div class="text-center text-white mb-8">
                    <div class="inline-flex items-center gap-2 bg-white/20 backdrop-blur-md px-4 py-1.5 rounded-full border border-white/20 mb-3">
                        <div class="w-2 h-2 rounded-full bg-orange-400 animate-pulse"></div>
                        <span class="text-[10px] font-bold uppercase tracking-wider">Darurat / Manual Input</span>
                    </div>
                    <h1 class="text-2xl font-extrabold">Input Transaksi Manual</h1>
                    <p class="text-emerald-100 text-sm mt-1">Gunakan fitur ini jika alat IoT sedang offline.</p>
                </div>
            </div>
        </div>

        <div class="max-w-xl mx-auto px-4 -mt-24 relative z-30">
            <div class="bg-white p-8 rounded-[2.5rem] shadow-xl border border-slate-100">
                <form action="{{ route('simulation.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-3">Pilih Jenis Sampah</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="cursor-pointer relative group">
                                <input type="radio" name="waste_type" value="anorganic" class="peer sr-only" x-model="wasteType">
                                <div class="p-5 rounded-2xl border-2 border-slate-100 text-center transition-all duration-300 hover:border-emerald-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-lg peer-checked:-translate-y-1">
                                    <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </div>
                                    <span class="block font-bold text-slate-700 peer-checked:text-emerald-700">Anorganik</span>
                                    <span class="text-[10px] text-slate-400">Botol, Gelas</span>
                                </div>
                                <div class="absolute top-3 right-3 text-emerald-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </label>

                            <label class="cursor-pointer relative group">
                                <input type="radio" name="waste_type" value="organic" class="peer sr-only" x-model="wasteType">
                                <div class="p-5 rounded-2xl border-2 border-slate-100 text-center transition-all duration-300 hover:border-emerald-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 peer-checked:shadow-lg peer-checked:-translate-y-1">
                                    <div class="w-12 h-12 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                    </div>
                                    <span class="block font-bold text-slate-700 peer-checked:text-emerald-700">Organik</span>
                                    <span class="text-[10px] text-slate-400">Sisa Makanan</span>
                                </div>
                                <div class="absolute top-3 right-3 text-emerald-500 opacity-0 peer-checked:opacity-100 transition-opacity">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Jumlah / Berat</label>
                        <div class="relative">
                            <input type="number" step="0.1" name="amount" class="w-full h-16 rounded-2xl border-slate-200 focus:border-emerald-500 focus:ring-emerald-500 pl-6 pr-20 font-bold text-3xl text-slate-800 placeholder-slate-300" placeholder="0">
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 text-sm font-bold text-slate-400 bg-slate-100 px-3 py-1.5 rounded-lg border border-slate-200">
                                <span x-text="wasteType === 'organic' ? 'Kg' : 'Pcs'"></span>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400 mt-2 ml-1" x-text="wasteType === 'organic' ? 'Masukkan berat dalam Kilogram.' : 'Masukkan jumlah barang dalam Pcs.'"></p>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-500 to-teal-600 text-white rounded-2xl font-bold shadow-xl shadow-emerald-500/30 hover:shadow-emerald-500/50 hover:scale-[1.02] transition-all duration-300 flex items-center justify-center gap-2">
                            <span>Simpan Transaksi</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>
</x-app-layout>