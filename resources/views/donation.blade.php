<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">
        
        <div class="bg-gradient-to-br from-teal-500 to-emerald-700 rounded-b-[4rem] shadow-lg relative overflow-hidden">
            <div class="absolute top-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full -translate-x-10 -translate-y-10"></div>
            <div class="absolute bottom-0 right-0 w-60 h-60 bg-white opacity-10 rounded-full translate-x-20 translate-y-20"></div>

            <div class="max-w-7xl mx-auto px-6 pt-10 pb-60 sm:px-8 sm:pb-52">
                <div class="flex justify-between items-center relative z-20">
                    <div class="flex items-center gap-4">
                        <a href="{{ route('dashboard') }}" class="bg-white/20 p-2 rounded-xl hover:bg-white/30 transition text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        </a>
                        <div class="text-white">
                            <p class="text-emerald-100 text-sm font-medium">Berbagi Kebaikan</p>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Sedekah & Infaq</h1>
                        </div>
                    </div>
                    <div class="bg-white p-2 rounded-xl shadow-md">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10 space-y-8">
            
            @if(session('success'))
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 rounded-r-xl shadow-md flex items-center gap-3 animate-fade-in-up">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-r-xl shadow-md flex items-center gap-3 animate-fade-in-up">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <div>
                    <p class="font-bold">Gagal Memproses</p>
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2 space-y-6">
                    
                    <div class="bg-[#0f172a] rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden transform transition hover:scale-[1.01]">
                        <div class="absolute top-0 right-0 w-40 h-40 bg-teal-500/20 rounded-full blur-3xl -mr-10 -mt-10"></div>
                        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <p class="text-gray-400 text-sm mb-1">Saldo Kebaikan</p>
                                <h2 class="text-4xl md:text-5xl font-bold tracking-tight text-teal-400">
                                    Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}
                                </h2>
                                <p class="text-xs text-gray-500 mt-2">*Harta tidak akan berkurang karena sedekah</p>
                            </div>
                            <div class="p-4 bg-white/10 rounded-2xl border border-white/10">
                                <svg class="w-8 h-8 text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <span class="bg-teal-100 p-2 rounded-lg text-teal-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                            </span>
                            Salurkan Donasi
                        </h3>
                        
                        <form action="{{ route('donation.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Lembaga</label>
                                    <div class="relative">
                                        <select name="institution" class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-teal-500 focus:ring-teal-500 py-3 px-4 transition">
                                            <option value="Lazismu">Lazismu (Zakat & Infaq)</option>
                                            <option value="MDMC">MDMC (Bencana Alam)</option>
                                            <option value="Panti Asuhan Aisyiyah">Panti Asuhan Aisyiyah</option>
                                            <option value="Beasiswa Mentari">Beasiswa Pendidikan</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nominal Infaq</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-bold">Rp</span>
                                        </div>
                                        <input type="number" name="amount" min="1000" class="block w-full pl-12 rounded-xl border-gray-200 bg-gray-50 focus:border-teal-500 focus:ring-teal-500 py-3 px-4 transition" placeholder="0" required>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Doa / Harapan (Opsional)</label>
                                <textarea name="prayer" rows="2" class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-teal-500 focus:ring-teal-500 py-3 px-4 transition" placeholder="Semoga berkah dan bermanfaat..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-teal-500 to-emerald-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 transform hover:-translate-y-1 transition duration-300">
                                Bismillah, Kirim Donasi
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Jejak Kebaikan
                            </h3>
                        </div>
                        <div class="divide-y divide-gray-100 overflow-y-auto max-h-[600px] p-2">
                            @forelse($history as $item)
                            <div class="p-4 hover:bg-gray-50 transition rounded-xl group">
                                <div class="flex justify-between items-start mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="bg-teal-100 p-2 rounded-lg text-teal-600 group-hover:bg-teal-500 group-hover:text-white transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                        </div>
                                        <div>
                                            <p class="font-bold text-gray-800 text-sm">{{ $item->institution }}</p>
                                            <p class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</p>
                                        </div>
                                    </div>
                                    <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-emerald-100 text-emerald-600">
                                        BERHASIL
                                    </span>
                                </div>
                                <p class="text-right font-bold text-teal-600">- Rp {{ number_format($item->amount, 0, ',', '.') }}</p>
                                @if($item->prayer)
                                <div class="mt-2 bg-gray-50 p-2 rounded-lg">
                                    <p class="text-xs text-gray-500 italic">"{{ $item->prayer }}"</p>
                                </div>
                                @endif
                            </div>
                            @empty
                            <div class="flex flex-col items-center justify-center py-10 text-center">
                                <div class="bg-gray-50 p-4 rounded-full mb-3">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                </div>
                                <p class="text-gray-400 text-sm">Belum ada riwayat sedekah.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>