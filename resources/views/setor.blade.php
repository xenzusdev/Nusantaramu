<x-app-layout>
    <x-slot name="title">Setor Sampah</x-slot>
    <x-slot name="header"></x-slot>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        .glass-card-dark {
            background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }
        @keyframes pulse-ring {
            0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
            70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
            100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
        }
        .btn-pulse { animation: pulse-ring 2s infinite; }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
        [x-cloak] { display: none !important; }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" x-data="setorLogic()">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] -translate-x-1/2 -translate-y-1/2 animate-pulse"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale" alt="Pattern">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-10 sm:px-8">
                <div class="flex justify-between items-center mb-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-white/80 hover:text-white transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        <span class="text-sm font-bold">Kembali</span>
                    </a>
                    <span class="font-bold text-white text-lg">Setor Sampah</span>
                    <div class="w-5"></div> 
                </div>

                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-3xl p-6 text-center text-white mb-8 shadow-lg">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-3 animate-bounce border border-white/30">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h2 class="text-xl font-bold">Terhubung ke Alat</h2>
                    <p class="text-emerald-200 font-mono font-bold tracking-widest text-lg">{{ $deviceCode }}</p>
                    <p class="text-xs text-white/70 mt-2">Pilih jenis sampah yang ingin kamu setor.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <button @click="triggerAlat('organic')" :disabled="loading" 
                        class="relative group h-64 w-full rounded-[2.5rem] overflow-hidden shadow-xl transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                        <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-orange-600"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white z-10 p-6">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 backdrop-blur-sm border border-white/30">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black tracking-tight">ORGANIK</h3>
                            <p class="text-orange-100 text-sm font-medium mt-1">Sisa Makanan, Daun</p>
                        </div>
                    </button>

                    <button @click="triggerAlat('anorganic')" :disabled="loading"
                        class="relative group h-64 w-full rounded-[2.5rem] overflow-hidden shadow-xl transition-all duration-300 hover:shadow-2xl hover:scale-[1.02] active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-indigo-600"></div>
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-white z-10 p-6">
                            <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4 backdrop-blur-sm border border-white/30">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </div>
                            <h3 class="text-2xl font-black tracking-tight">ANORGANIK</h3>
                            <p class="text-blue-100 text-sm font-medium mt-1">Botol Plastik, Cup</p>
                        </div>
                    </button>
                </div>
            </div>

            <div x-show="loading" class="fixed inset-0 z-[200] flex flex-col items-center justify-center bg-slate-900/90 backdrop-blur-md text-white text-center p-6" x-transition.opacity>
                <div class="relative w-24 h-24 mb-6">
                    <div class="absolute inset-0 border-4 border-slate-700 rounded-full"></div>
                    <div class="absolute inset-0 border-4 border-emerald-500 rounded-full border-t-transparent animate-spin"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <svg class="w-8 h-8 text-emerald-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                </div>
                <h3 class="text-2xl font-bold mb-2">Memproses Sampah...</h3>
                <p class="text-slate-400 text-sm max-w-xs mx-auto">Silakan masukkan sampah ke dalam alat. Sistem sedang menghitung berat secara otomatis.</p>
                <p class="mt-8 text-xs font-mono text-emerald-500 bg-emerald-500/10 px-3 py-1 rounded-full animate-pulse">Menunggu respon alat...</p>
            </div>

            <div x-show="successData" class="fixed inset-0 z-[300] flex items-center justify-center p-4 bg-emerald-900/90 backdrop-blur-xl" x-transition x-cloak>
                <div class="bg-white rounded-[2.5rem] w-full max-w-sm overflow-hidden shadow-2xl relative text-center p-8">
                    <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce">
                        <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800 mb-1">Berhasil!</h2>
                    <p class="text-slate-500 text-sm mb-6">Sampah berhasil ditimbang.</p>
                    
                    <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs text-slate-400 font-bold uppercase">Berat/Jumlah</span>
                            <span class="text-lg font-bold text-slate-800"><span x-text="successData?.amount"></span> <span x-text="successData?.type == 'organic' ? 'Kg' : 'Pcs'"></span></span>
                        </div>
                        <div class="border-t border-slate-200 my-2 border-dashed"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-xs text-slate-400 font-bold uppercase">Poin Didapat</span>
                            <span class="text-2xl font-black text-emerald-500">+<span x-text="successData?.points"></span></span>
                        </div>
                    </div>

                    <a href="{{ route('dashboard') }}" class="block w-full py-4 bg-emerald-600 text-white rounded-xl font-bold text-sm shadow-lg hover:bg-emerald-700 transition">
                        Kembali ke Dashboard
                    </a>
                </div>
            </div>

        </div>

        @include('layouts.partials.mobile-nav')

    </div>

    <script>
        function setorLogic() {
            return {
                loading: false,
                successData: null,
                pollInterval: null,
                
                triggerAlat(type) {
                    this.loading = true;
                    
                    // 1. Kirim Perintah ke Alat
                    fetch('{{ route("setor.trigger") }}', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                        body: JSON.stringify({ type: type })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.status === 'success') {
                            // 2. Jika sukses kirim perintah, mulai Polling Cek Transaksi
                            this.startPolling();
                        } else {
                            this.loading = false;
                            alert('Gagal menghubungi alat: ' + data.message);
                        }
                    })
                    .catch(err => {
                        this.loading = false;
                        console.error(err);
                        alert('Koneksi Error');
                    });
                },

                startPolling() {
                    // Cek setiap 2 detik apakah alat sudah kirim data balik
                    this.pollInterval = setInterval(() => {
                        fetch('/check-transaction/{{ $deviceCode }}')
                            .then(res => res.json())
                            .then(data => {
                                if (data.status === 'found') {
                                    // STOP Polling
                                    clearInterval(this.pollInterval);
                                    
                                    // Tampilkan Data Sukses
                                    this.loading = false;
                                    this.successData = data;
                                }
                            });
                    }, 2000);
                }
            }
        }
    </script>
</x-app-layout>