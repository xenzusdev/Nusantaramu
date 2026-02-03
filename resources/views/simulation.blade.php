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
                            <p class="text-emerald-100 text-sm font-medium">Menu Utama</p>
                            <h1 class="text-2xl sm:text-3xl font-bold tracking-tight">Setor Sampah</h1>
                        </div>
                    </div>
                    <div class="bg-white p-2 rounded-xl shadow-md">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="h-10 w-10 object-contain">
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-32 relative z-10 space-y-8">
            
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-xl shadow-md flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-full text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                </div>
                <div>
                    <p class="font-bold text-gray-800">Simulasi Mesin IoT</p>
                    <p class="text-xs text-gray-500">Gunakan halaman ini untuk simulasi setor sampah jika alat fisik belum tersedia.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <span class="bg-emerald-100 p-2 rounded-lg text-emerald-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </span>
                            Input Sampah
                        </h3>
                        
                        <form action="{{ route('simulation.store') }}" method="POST" class="space-y-6">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="waste_type" value="anorganic" class="peer sr-only" checked>
                                    <div class="p-4 rounded-2xl border-2 border-gray-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 transition hover:bg-gray-50">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-blue-100 p-3 rounded-xl text-blue-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800">Anorganik</p>
                                                <p class="text-xs text-gray-500">Botol, Plastik, Kaleng</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>

                                <label class="cursor-pointer">
                                    <input type="radio" name="waste_type" value="organic" class="peer sr-only">
                                    <div class="p-4 rounded-2xl border-2 border-gray-200 peer-checked:border-green-500 peer-checked:bg-green-50 transition hover:bg-gray-50">
                                        <div class="flex items-center gap-3">
                                            <div class="bg-green-100 p-3 rounded-xl text-green-600">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-800">Organik</p>
                                                <p class="text-xs text-gray-500">Sisa Makanan, Daun</p>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Berat / Pcs</label>
                                <div class="relative">
                                    <input type="number" step="0.1" name="amount" class="block w-full rounded-xl border-gray-200 bg-gray-50 focus:border-emerald-500 focus:ring-emerald-500 py-3 px-4 transition" placeholder="Contoh: 1.5 atau 5" required>
                                    <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-400 text-sm">
                                        Kg / Pcs
                                    </div>
                                </div>
                                <p class="text-xs text-gray-400 mt-2">*Organik dihitung per Kg, Anorganik per Pcs (Botol)</p>
                            </div>

                            <button type="submit" class="w-full bg-gradient-to-r from-emerald-500 to-teal-600 text-white font-bold py-4 rounded-xl shadow-lg shadow-emerald-500/30 hover:shadow-emerald-500/50 transform hover:-translate-y-1 transition duration-300">
                                Proses Setor Sampah
                            </button>
                        </form>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100">
                        <h3 class="font-bold text-gray-800 mb-4">Informasi Nilai Tukar</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between p-3 bg-blue-50 rounded-xl border border-blue-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-gray-600">Botol Plastik</span>
                                </div>
                                <span class="text-sm font-bold text-blue-600">Rp 50 / Pcs</span>
                            </div>
                            <div class="flex items-center justify-between p-3 bg-green-50 rounded-xl border border-green-100">
                                <div class="flex items-center gap-3">
                                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                    <span class="text-sm font-medium text-gray-600">Sampah Organik</span>
                                </div>
                                <span class="text-sm font-bold text-green-600">Rp 500 / Kg</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>