<x-app-layout>
    <x-slot name="title">Scan & Kontrol - Nusantaramu</x-slot>
    <x-slot name="header"></x-slot>

    <head>
        <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('img/logo.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

        <style>
            /* Scrollbar & Utils */
            ::-webkit-scrollbar { width: 6px; }
            ::-webkit-scrollbar-track { background: transparent; }
            ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
            nav.bg-white.border-b { display: none !important; }
            .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
            [x-cloak] { display: none !important; }

            /* Animations */
            @keyframes fade-in-up { from { opacity: 0; transform: translateY(15px); } to { opacity: 1; transform: translateY(0); } }
            .animate-entrance { animation: fade-in-up 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
            @keyframes pulse-ring { 0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); } 70% { transform: scale(1); box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); } 100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }
            .blob-pulse { animation: pulse-ring 2s infinite; }

            /* Scanner Line */
            @keyframes scan-line { 0% { top: 0%; opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { top: 100%; opacity: 0; } }
            .scanner-line { position: absolute; left: 0; width: 100%; height: 3px; background: #10b981; box-shadow: 0 0 10px #10b981; animation: scan-line 2s linear infinite; }
            
            /* Glass Dark */
            .glass-card-dark { background: linear-gradient(145deg, #0f172a 0%, #1e293b 100%); position: relative; overflow: hidden; border: 1px solid rgba(255, 255, 255, 0.08); }
            #reader video { object-fit: cover; border-radius: 1.5rem; }
        </style>
    </head>

    <div class="min-h-screen bg-[#F8FAFC] font-sans pb-24 md:pb-12" x-data="deviceLogic()">
        
        <div class="bg-white/80 backdrop-blur-md sticky top-0 z-[100] border-b border-slate-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center gap-3">
                        <a href="{{ route('dashboard') }}" class="group flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-500 group-hover:bg-emerald-500 group-hover:text-white transition shadow-sm">
                                <svg class="w-5 h-5 group-hover:-translate-x-0.5 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </div>
                            <span class="font-bold text-lg text-slate-800 group-hover:text-emerald-600 transition">Kembali</span>
                        </a>
                    </div>
                    <div class="flex items-center gap-4">
                        <span class="text-xs font-bold text-slate-400 uppercase tracking-widest hidden sm:block">Kontrol Alat</span>
                        <div class="w-8 h-8 bg-emerald-500 rounded-lg flex items-center justify-center shadow-sm">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-5 h-5 object-contain brightness-0 invert">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="relative w-full pb-32">
            <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-900 h-80 rounded-b-[3rem] shadow-xl overflow-hidden">
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2"></div>
                <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-[80px] translate-x-1/3 translate-y-1/3"></div>
            </div>
            
            <div class="relative z-10 max-w-7xl mx-auto px-6 pt-10 text-center">
                @if(session('connected_device'))
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-500/20 border border-emerald-500/50 rounded-full mb-4 animate-pulse">
                        <span class="w-2 h-2 bg-emerald-400 rounded-full"></span>
                        <span class="text-emerald-300 text-xs font-bold font-mono tracking-wider">ONLINE: {{ session('connected_device') }}</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">Alat Terhubung</h1>
                    <p class="text-slate-400 text-sm mt-3 max-w-lg mx-auto">Pilih jenis sampah untuk mengaktifkan kamera scan sampah pada alat.</p>
                @else
                    <h1 class="text-3xl md:text-4xl font-black text-white tracking-tight drop-shadow-md">Koneksi Alat</h1>
                    <p class="text-slate-400 text-sm mt-3 max-w-lg mx-auto">Scan QR Code pada layar mesin untuk memulai sesi penyetoran.</p>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-20 space-y-8 animate-entrance">
            
            @if(!session('connected_device'))
            <div class="glass-card-dark rounded-[2.5rem] shadow-2xl border border-slate-700 overflow-hidden">
                <div class="p-6 md:p-8 text-center">
                    <div class="relative w-full max-w-md mx-auto aspect-square bg-black rounded-3xl overflow-hidden border-4 border-slate-700 shadow-inner group">
                        <div id="reader" class="w-full h-full object-cover"></div>

                        <div x-show="!isScanning" class="absolute inset-0 flex flex-col items-center justify-center bg-slate-900/90 z-20">
                            <div class="p-4 bg-emerald-500/20 rounded-full mb-4 blob-pulse">
                                <svg class="w-10 h-10 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"></path></svg>
                            </div>
                            <button @click="startScanner()" class="px-8 py-3 bg-emerald-500 hover:bg-emerald-400 text-white font-bold rounded-xl transition shadow-lg shadow-emerald-500/30 transform hover:-translate-y-1">
                                Aktifkan Kamera
                            </button>
                        </div>

                        <div x-show="isScanning" class="absolute inset-0 pointer-events-none z-10">
                            <div class="scanner-line"></div>
                            <div class="absolute top-4 right-4">
                                <span class="bg-red-500/80 text-white text-[10px] font-bold px-2 py-1 rounded-md animate-pulse">LIVE</span>
                            </div>
                            <button @click="stopScanner()" class="absolute bottom-4 left-1/2 -translate-x-1/2 px-4 py-2 bg-slate-900/50 backdrop-blur-md text-white text-xs font-bold rounded-lg border border-white/20 pointer-events-auto hover:bg-slate-900/80 transition">
                                Stop Scan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if(session('connected_device'))
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                
                <button @click="triggerDevice('anorganic')" :disabled="isLoading" class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-300 transition-all duration-300 text-left overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition duration-500"></div>
                    
                    <div class="relative z-10 flex flex-col h-full justify-between min-h-[200px]">
                        <div class="bg-blue-100 w-14 h-14 rounded-2xl flex items-center justify-center text-blue-600 shadow-sm group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 group-hover:text-blue-700 transition">Anorganik</h3>
                            <p class="text-sm text-slate-500 mt-1">Botol Plastik, Kaleng, Gelas</p>
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-blue-600 font-bold text-sm">
                            <span x-text="isLoading ? 'Menghubungkan...' : 'Buka Scanner Botol'"></span>
                            <svg x-show="!isLoading" class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            <svg x-show="isLoading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </div>
                    </div>
                </button>

                <button @click="triggerDevice('organic')" :disabled="isLoading" class="group relative bg-white rounded-[2.5rem] p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:shadow-orange-500/10 hover:border-orange-300 transition-all duration-300 text-left overflow-hidden disabled:opacity-50 disabled:cursor-not-allowed">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition duration-500"></div>
                    
                    <div class="relative z-10 flex flex-col h-full justify-between min-h-[200px]">
                        <div class="bg-orange-100 w-14 h-14 rounded-2xl flex items-center justify-center text-orange-600 shadow-sm group-hover:bg-orange-500 group-hover:text-white transition duration-300">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-800 group-hover:text-orange-600 transition">Organik</h3>
                            <p class="text-sm text-slate-500 mt-1">Sisa Makanan, Daun, Ranting</p>
                        </div>
                        <div class="mt-4 flex items-center gap-2 text-orange-600 font-bold text-sm">
                            <span x-text="isLoading ? 'Menghubungkan...' : 'Buka Scanner Organik'"></span>
                            <svg x-show="!isLoading" class="w-4 h-4 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            <svg x-show="isLoading" class="w-4 h-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        </div>
                    </div>
                </button>

            </div>

            <div class="text-center mt-8">
                <form action="{{ route('simulation.reset') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-slate-400 text-sm font-bold hover:text-rose-500 transition flex items-center justify-center gap-2 mx-auto">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Putuskan Koneksi Alat
                    </button>
                </form>
            </div>
            @endif

        </div>

        @include('layouts.partials.mobile-nav')
    </div>

    <script>
        function deviceLogic() {
            return {
                isScanning: false,
                isLoading: false,
                html5QrcodeScanner: null,

                init() {
                    @if(session('success'))
                        // Bisa diganti toast notification nanti
                        console.log("{{ session('success') }}");
                    @endif
                },

                // ---- SCANNER FUNCTIONS ----
                startScanner() {
                    this.isScanning = true;
                    this.html5QrcodeScanner = new Html5Qrcode("reader");
                    
                    const config = { fps: 10, qrbox: { width: 250, height: 250 }, aspectRatio: 1.0 };
                    
                    this.html5QrcodeScanner.start(
                        { facingMode: "environment" }, 
                        config,
                        (decodedText) => {
                            this.stopScanner();
                            // Redirect ke route connect untuk menyimpan session alat
                            window.location.href = '/device/connect/' + encodeURIComponent(decodedText);
                        },
                        (errorMessage) => { /* ignore */ }
                    ).catch(err => {
                        console.error(err);
                        alert("Gagal membuka kamera. Pastikan izin diberikan.");
                        this.isScanning = false;
                    });
                },

                stopScanner() {
                    if (this.html5QrcodeScanner) {
                        this.html5QrcodeScanner.stop().then(() => {
                            this.html5QrcodeScanner.clear();
                            this.isScanning = false;
                        }).catch(err => console.log(err));
                    }
                },

                // ---- TRIGGER ESP32 FUNCTIONS ----
                triggerDevice(type) {
                    this.isLoading = true;
                    
                    // Disini nanti integrasi ke API Backend yang nembak ke ESP32 (MQTT/HTTP)
                    // Untuk sekarang kita simulasi delay loading saja
                    
                    console.log("Triggering ESP32 for: " + type);

                    fetch('/device/trigger', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ type: type })
                    })
                    .then(response => {
                        if (response.ok) {
                            // Redirect atau tampilkan notifikasi sukses menunggu hasil scan alat
                            alert('Perintah dikirim ke alat! Silahkan masukkan sampah ' + type);
                        } else {
                            alert('Gagal mengirim perintah ke alat.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Fallback simulasi frontend jika backend belum siap
                        setTimeout(() => {
                            alert('Simulasi: Alat aktif untuk mode ' + type);
                            this.isLoading = false;
                        }, 1000);
                    })
                    .finally(() => {
                        this.isLoading = false;
                    });
                }
            }
        }
    </script>
</x-app-layout>