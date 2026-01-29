<x-app-layout>
    <div class="min-h-screen bg-gray-50 pb-20">
        
        <div class="bg-gradient-to-br from-teal-500 to-emerald-700 rounded-b-[4rem] shadow-lg relative overflow-hidden">
            <div class="absolute top-0 left-0 w-40 h-40 bg-white opacity-10 rounded-full -translate-x-10 -translate-y-10"></div>
            <div class="absolute bottom-0 right-0 w-60 h-60 bg-white opacity-10 rounded-full translate-x-20 translate-y-20"></div>

            <div class="max-w-7xl mx-auto px-6 pt-10 pb-48 sm:px-8 sm:pb-40">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="bg-white p-2 rounded-xl shadow-md">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                        </div>
                        <div class="text-white">
                            <p class="text-emerald-100 text-sm font-medium">Selamat Datang,</p>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">{{ Auth::user()->name }}</h1>
                        </div>
                    </div>
                    <button class="relative p-2 bg-white/20 backdrop-blur-sm rounded-full hover:bg-white/30 transition">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-red-400 rounded-full border border-teal-600"></span>
                    </button>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-40 relative z-10 space-y-8">
            
            @if(session('connected_device'))
            <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-r-xl shadow-md flex justify-between items-center animate-fade-in-up">
                <div class="flex items-center gap-3">
                    <div class="bg-emerald-100 p-2 rounded-full">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <div>
                        <p class="font-bold text-gray-800">Terhubung ke IoT</p>
                        <p class="text-xs text-gray-500">Device ID: <span class="font-mono font-bold">{{ session('connected_device') }}</span></p>
                    </div>
                </div>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="bg-[#0f172a] rounded-3xl p-6 text-white shadow-2xl relative overflow-hidden group hover:scale-[1.02] transition duration-300">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/20 rounded-full blur-2xl -mr-10 -mt-10"></div>
                    
                    <div class="flex items-center gap-4 mb-6">
                        <div class="p-3 bg-white/10 rounded-full border border-white/10">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-gray-400 text-sm">Total Poin</p>
                            <h2 class="text-4xl font-bold tracking-tight">{{ number_format($user->points_balance) }}</h2>
                        </div>
                    </div>

                    <div class="space-y-1 mb-6">
                        <div class="flex justify-between text-sm text-gray-400">
                            <span>Estimasi Rupiah</span>
                            <span class="text-emerald-400 font-bold">Rp {{ number_format($user->wallet_balance, 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-gray-700 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-400 to-teal-400 h-full rounded-full" style="width: 70%"></div>
                        </div>
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('withdraw.index') }}" class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white py-3 rounded-xl font-semibold text-center text-sm transition shadow-lg shadow-emerald-500/30">
                            Tukar Poin
                        </a>
                        <a href="#riwayat" class="flex-1 border border-gray-600 hover:border-gray-400 text-gray-300 hover:text-white py-3 rounded-xl font-semibold text-center text-sm transition">
                            Riwayat
                        </a>
                    </div>
                </div>

                <div class="space-y-6">
                    <a href="{{ route('simulation') }}" class="group bg-white p-5 rounded-3xl shadow-sm border border-gray-100 hover:border-emerald-200 hover:shadow-md transition flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="bg-emerald-100 p-3.5 rounded-2xl group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg">Setor Sampah</h4>
                                <p class="text-xs text-gray-500">Mulai setor dan dapatkan poin</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:bg-emerald-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </a>

                    <div class="group bg-white p-5 rounded-3xl shadow-sm border border-gray-100 hover:border-emerald-200 hover:shadow-md transition flex items-center justify-between cursor-pointer">
                        <div class="flex items-center gap-4">
                            <div class="bg-teal-100 p-3.5 rounded-2xl group-hover:scale-110 transition">
                                <svg class="w-6 h-6 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-lg">Sedekah</h4>
                                <p class="text-xs text-gray-500">Tukarkan poinmu jadi amal</p>
                            </div>
                        </div>
                        <div class="bg-gray-50 p-2 rounded-full text-gray-400 group-hover:bg-teal-500 group-hover:text-white transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="grid grid-cols-2 lg:grid-cols-1 gap-4">
                        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                            <div class="bg-blue-100 p-4 rounded-2xl">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">{{ $totalAnorganic }}</h4>
                                <p class="text-xs text-gray-500 font-medium">Botol & Cup Plastik</p>
                            </div>
                        </div>

                        <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                            <div class="bg-green-100 p-4 rounded-2xl">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-gray-900">{{ $totalOrganic }} <span class="text-sm text-gray-400">Kg</span></h4>
                                <p class="text-xs text-gray-500 font-medium">Limbah Organik</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="bg-[#0f172a] rounded-3xl p-8 mt-8 text-center relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-teal-500 via-emerald-500 to-teal-500"></div>
                <p class="text-gray-300 italic text-sm md:text-base leading-relaxed">
                    "The only way forward, if we are going to improve the quality of the environment, is to get everybody involved."
                </p>
                <p class="text-emerald-500 font-bold text-xs mt-4 uppercase tracking-widest">- Richard Rogers</p>
            </div>

            <div id="riwayat" class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Riwayat Terakhir</h3>
                    <a href="#" class="text-xs font-bold text-emerald-600 hover:underline">Lihat Semua</a>
                </div>
                <div class="divide-y divide-gray-100">
                    @forelse($transactions as $trx)
                    <div class="p-4 hover:bg-gray-50 transition flex items-center justify-between">
                        <div class="flex items-center gap-4">
                            <div class="{{ $trx->waste_type == 'organic' ? 'bg-green-100 text-green-600' : 'bg-blue-100 text-blue-600' }} p-3 rounded-xl">
                                @if($trx->waste_type == 'organic')
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                                @else
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                @endif
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 capitalize">{{ $trx->waste_type }}</p>
                                <p class="text-xs text-gray-500">{{ $trx->created_at->format('d M Y, H:i') }} • {{ $trx->device_code }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-emerald-600">+{{ $trx->points_earned }} Poin</p>
                            <p class="text-xs text-gray-400">{{ $trx->amount }} {{ $trx->waste_type == 'organic' ? 'Kg' : 'Pcs' }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400 italic text-sm">Belum ada transaksi</div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>