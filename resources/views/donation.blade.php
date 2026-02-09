<x-app-layout>
    <x-slot name="title">Sedekah - Nusantaramu</x-slot>
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
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" x-data="donationLogic()">
        
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
                    
                    <span class="font-bold text-white text-lg">Sedekah</span>
                </div>

                <div class="text-center text-white mb-6">
                    <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight drop-shadow-md">Salurkan Kebaikan</h1>
                    <p class="text-emerald-100 text-sm mt-2 max-w-lg mx-auto leading-relaxed">
                        "Harta tidak akan berkurang karena sedekah, melainkan akan bertambah dan penuh berkah."
                    </p>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-30 animate-entrance">
            
            @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-100 p-4 rounded-2xl shadow-lg shadow-emerald-500/10 flex items-center gap-4 animate-bounce-in mb-6">
                <div class="bg-emerald-100 p-2.5 rounded-full text-emerald-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-emerald-900 text-sm">Alhamdulillah!</p>
                    <p class="text-emerald-700 text-xs">{{ session('success') }}</p>
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
                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-2">Saldo Dompet Anda</p>
                            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight">Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}</h2>
                            <p class="text-xs text-emerald-400 mt-2 font-bold flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Siap didonasikan
                            </p>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2.5rem] p-8 shadow-xl border border-slate-100 relative">
                        <div class="flex items-center gap-3 mb-8">
                            <div class="bg-emerald-100 p-2.5 rounded-xl text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800">Detail Sedekah</h3>
                        </div>
                        
                        <form action="{{ route('donation.store') }}" method="POST" class="space-y-8">
                            @csrf
                            
                            <div class="space-y-3 relative z-50">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Tujuan Donasi</label>
                                
                                <div class="relative" x-data="{ open: false }">
                                    <input type="hidden" name="institution" x-model="selectedInst">

                                    <button type="button" @click="open = !open" @click.away="open = false"
                                            class="w-full bg-slate-50 border border-slate-200 rounded-2xl p-4 flex items-center justify-between hover:border-emerald-400 hover:bg-white hover:shadow-md transition-all duration-300 focus:outline-none group">
                                        <div class="flex items-center gap-4 overflow-hidden">
                                            <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-white border border-slate-100 flex items-center justify-center p-1 shadow-sm group-hover:scale-105 transition">
                                                <img :src="getLogo()" x-on:error="$el.style.display='none'; $refs.fallback.style.display='flex'" class="w-full h-full object-contain" alt="Logo">
                                                <div x-ref="fallback" class="hidden w-full h-full items-center justify-center text-emerald-600 font-black text-lg bg-emerald-50 rounded-lg">
                                                    <span x-text="getInitial()"></span>
                                                </div>
                                            </div>
                                            <div class="text-left overflow-hidden">
                                                <p class="font-bold text-slate-800 text-sm md:text-base truncate" x-text="getLabel()"></p>
                                                <p class="text-xs text-slate-500 truncate" x-text="getDesc()"></p>
                                            </div>
                                        </div>
                                        <div class="flex-shrink-0 bg-white p-2 rounded-full shadow-sm text-slate-400 group-hover:text-emerald-600 transition border border-slate-100 ml-2">
                                            <svg class="w-4 h-4 transition-transform duration-300" :class="{'rotate-180': open}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </button>

                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 translate-y-4"
                                         class="absolute w-full bg-white border border-slate-100 rounded-2xl shadow-xl mt-3 overflow-hidden z-[60] p-2">
                                        
                                        <template x-for="option in options" :key="option.id">
                                            <div @click="selectOption(option.id)" 
                                                 class="p-3 rounded-xl flex items-center gap-4 cursor-pointer transition hover:bg-emerald-50 group"
                                                 :class="{'bg-emerald-50 ring-1 ring-emerald-500/20': selectedInst === option.id}">
                                                <div class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center bg-white border border-slate-100 p-1 shadow-sm">
                                                    <img :src="option.logo" x-on:error="$el.style.display='none'; $el.nextElementSibling.style.display='flex'" class="w-full h-full object-contain">
                                                    <div class="hidden w-full h-full items-center justify-center text-slate-500 font-bold text-sm bg-slate-50 rounded">
                                                        <span x-text="option.initial"></span>
                                                    </div>
                                                </div>
                                                <div class="overflow-hidden">
                                                    <p class="font-bold text-slate-800 text-sm group-hover:text-emerald-700 transition truncate" x-text="option.label"></p>
                                                    <p class="text-[10px] text-slate-500 truncate" x-text="option.desc"></p>
                                                </div>
                                                <div class="ml-auto text-emerald-600 flex-shrink-0" x-show="selectedInst === option.id">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Nominal Infaq</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                                        <span class="text-emerald-600 font-black text-lg group-focus-within:text-emerald-500 transition">Rp</span>
                                    </div>
                                    <input type="number" name="amount" min="1000" 
                                           class="block w-full pl-14 pr-16 rounded-2xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500 focus:bg-white py-4 text-lg font-bold text-slate-800 placeholder-slate-300 transition shadow-sm" 
                                           placeholder="0" required>
                                    <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none">
                                        <span class="text-[10px] font-bold text-slate-400 bg-white px-2 py-1 rounded-md border border-slate-100 shadow-sm">IDR</span>
                                    </div>
                                </div>
                                <div class="flex gap-2 overflow-x-auto pb-2 no-scrollbar">
                                    <button type="button" @click="setAmount(5000)" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md transition whitespace-nowrap active:scale-95">Rp 5.000</button>
                                    <button type="button" @click="setAmount(10000)" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md transition whitespace-nowrap active:scale-95">Rp 10.000</button>
                                    <button type="button" @click="setAmount(20000)" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md transition whitespace-nowrap active:scale-95">Rp 20.000</button>
                                    <button type="button" @click="setAmount(50000)" class="px-4 py-2 bg-white border border-slate-200 rounded-xl text-xs font-bold text-slate-600 hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md transition whitespace-nowrap active:scale-95">Rp 50.000</button>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <label class="text-[11px] font-bold text-slate-400 uppercase tracking-wider ml-1">Doa & Harapan (Opsional)</label>
                                <textarea name="prayer" rows="3" 
                                          class="block w-full rounded-2xl border-slate-200 bg-slate-50 focus:border-emerald-500 focus:ring-emerald-500 focus:bg-white py-4 px-5 text-sm font-medium text-slate-700 placeholder-slate-300 transition resize-none shadow-sm" 
                                          placeholder="Tuliskan doa terbaikmu disini..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 hover:to-teal-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-emerald-500/30 hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition duration-300 flex items-center justify-center gap-2 group">
                                <span>Bismillah, Kirim Donasi</span>
                                <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
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
                                Jejak Kebaikan
                            </h3>
                        </div>
                        
                        <div class="divide-y divide-slate-50 overflow-y-auto max-h-[600px] p-2 custom-scrollbar">
                            @forelse($history as $item)
                            <div class="p-5 hover:bg-slate-50 transition rounded-2xl cursor-default">
                                <div class="flex justify-between items-start mb-3">
                                    <div class="flex items-center gap-3 overflow-hidden">
                                        <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-teal-50 flex items-center justify-center text-teal-600 font-bold shadow-sm border border-teal-100">
                                            @php
                                                $key = strtolower(explode(' ', $item->institution)[0]); 
                                                $logoPath = asset('img/' . $key . '.png');
                                            @endphp
                                            <img src="{{ $logoPath }}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex'" class="w-6 h-6 object-contain" alt="Icon">
                                            <span class="hidden text-sm">{{ substr($item->institution, 0, 1) }}</span>
                                        </div>
                                        <div class="overflow-hidden">
                                            <p class="font-bold text-slate-800 text-sm line-clamp-1">{{ $item->institution }}</p>
                                            <p class="text-[10px] text-slate-400 font-medium uppercase tracking-wide">{{ $item->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="flex-shrink-0 px-2 py-1 rounded-lg text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-700 border border-emerald-200">
                                        Sukses
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-end border-t border-slate-100 pt-3 mt-3">
                                    <p class="text-xs text-slate-400">Nominal</p>
                                    <p class="text-sm font-black text-emerald-600">- Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                </div>

                                @if($item->prayer)
                                <div class="mt-3 bg-slate-50 p-3 rounded-xl border border-slate-100 relative">
                                    <div class="absolute top-0 left-4 -mt-1 w-2 h-2 bg-slate-50 border-t border-l border-slate-100 transform rotate-45"></div>
                                    <p class="text-xs text-slate-500 italic leading-relaxed line-clamp-2">"{{ $item->prayer }}"</p>
                                </div>
                                @endif
                            </div>
                            @empty
                            <div class="flex flex-col items-center justify-center py-20 text-center px-6">
                                <div class="bg-slate-50 p-6 rounded-full mb-4 text-slate-300">
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <p class="text-slate-800 font-bold text-sm">Belum ada donasi.</p>
                                <p class="text-slate-400 text-xs mt-1 leading-relaxed">Mulai berbagi kebaikan hari ini, jejaknya akan muncul di sini.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')

    </div>

    <script>
        function donationLogic() {
            return {
                selectedInst: 'Lazismu',
                options: [
                    { id: 'Lazismu', label: 'Lazismu', desc: 'Lembaga Amil Zakat Nasional', initial: 'L', logo: "{{ asset('img/lazismu.png') }}" },
                    { id: 'MDMC', label: 'MDMC', desc: 'Tanggap Bencana & Kemanusiaan', initial: 'M', logo: "{{ asset('img/mdmc.png') }}" },
                    { id: 'Panti Asuhan', label: 'Panti Asuhan Aisyiyah', desc: 'Bantu Anak Yatim & Dhuafa', initial: 'P', logo: "{{ asset('img/panti.png') }}" },
                    { id: 'Beasiswa', label: 'Beasiswa Mentari', desc: 'Dukung Pendidikan Anak Bangsa', initial: 'B', logo: "{{ asset('img/beasiswa.png') }}" }
                ],
                selectOption(id) {
                    this.selectedInst = id;
                    this.open = false;
                },
                getLabel() {
                    return this.options.find(o => o.id === this.selectedInst).label;
                },
                getDesc() {
                    return this.options.find(o => o.id === this.selectedInst).desc;
                },
                getLogo() {
                    return this.options.find(o => o.id === this.selectedInst).logo;
                },
                getInitial() {
                    return this.options.find(o => o.id === this.selectedInst).initial;
                },
                setAmount(val) {
                    document.querySelector('input[name="amount"]').value = val;
                }
            }
        }
    </script>
</x-app-layout>