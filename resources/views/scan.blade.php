<x-app-layout>
    <x-slot name="title">Scan QR Alat</x-slot>
    <x-slot name="header"></x-slot>

    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <style>
        nav.bg-white.border-b.border-gray-100 { display: none !important; }
        #reader { width: 100%; height: 100%; border-radius: 1.5rem; overflow: hidden; background: #000; }
        #reader video { object-fit: cover; border-radius: 1.5rem; height: 100% !important; }
        .scanner-line {
            position: absolute; left: 0; width: 100%; height: 2px;
            background: #10b981; box-shadow: 0 0 4px #10b981;
            animation: scan-line 2s linear infinite;
        }
        @keyframes scan-line {
            0% { top: 0%; opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { top: 100%; opacity: 0; }
        }
        .safe-area-bottom { padding-bottom: env(safe-area-inset-bottom); }
    </style>

    <div class="min-h-screen bg-[#F8FAFC] font-sans relative pb-24 md:pb-12" x-data="scannerLogic()">
        
        <div class="relative w-full pb-32 lg:pb-40 -mt-20 pt-20">
            <div class="absolute inset-0 z-0 rounded-b-[3.5rem] overflow-hidden shadow-xl shadow-emerald-900/5">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 via-teal-600 to-emerald-800"></div>
                <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-white/10 rounded-full blur-[120px] animate-pulse"></div>
                <img src="{{ asset('img/hero.png') }}" class="absolute inset-0 w-full h-full object-cover opacity-10 mix-blend-overlay grayscale">
            </div>

            <div class="relative z-50 max-w-7xl mx-auto px-6 pt-10 sm:px-8">
                <div class="relative flex items-center justify-center mb-8">
                    <a href="{{ route('dashboard') }}" class="absolute left-0 flex items-center gap-2 text-white/80 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    <span class="text-sm font-bold">Kembali</span>
                </a>
    
                    <span class="font-bold text-white text-lg">Hubungkan Alat</span>
                </div>

                <div class="bg-white p-4 rounded-[2.5rem] shadow-2xl relative">
                    <div class="bg-slate-900 h-[400px] relative flex flex-col items-center justify-center overflow-hidden rounded-[2rem]">
                        <div id="reader" class="w-full h-full object-cover"></div>
                        
                        <div class="absolute inset-0 border-[30px] border-slate-900/50 flex items-center justify-center pointer-events-none z-10">
                            <div class="w-64 h-64 border-2 border-emerald-500 rounded-2xl relative overflow-hidden">
                                <div class="absolute top-0 left-0 w-4 h-4 border-t-4 border-l-4 border-emerald-500 -mt-1 -ml-1"></div>
                                <div class="absolute top-0 right-0 w-4 h-4 border-t-4 border-r-4 border-emerald-500 -mt-1 -mr-1"></div>
                                <div class="absolute bottom-0 left-0 w-4 h-4 border-b-4 border-l-4 border-emerald-500 -mb-1 -ml-1"></div>
                                <div class="absolute bottom-0 right-0 w-4 h-4 border-b-4 border-r-4 border-emerald-500 -mb-1 -mr-1"></div>
                                <div class="scanner-line"></div>
                            </div>
                        </div>

                        <div class="absolute bottom-10 z-20 text-center">
                            <p class="text-white font-bold text-lg drop-shadow-md">Scan QR Code</p>
                            <p class="text-emerald-300 text-xs mt-1">Arahkan kamera ke layar alat IoT</p>
                        </div>
                    </div>
                </div>
                
                <p class="text-center text-emerald-800 text-xs font-bold mt-6">Pastikan izin kamera aktif</p>
            </div>
        </div>

        @include('layouts.partials.mobile-nav')
    </div>

    <script>
        function scannerLogic() {
            return {
                scanner: null,
                init() {
                    this.startScanner();
                },
                startScanner() {
                    this.scanner = new Html5Qrcode("reader");
                    const config = { fps: 10, qrbox: { width: 250, height: 250 } };
                    
                    this.scanner.start({ facingMode: "environment" }, config, 
                        (decodedText) => {
                            this.scanner.stop().then(() => {
                                let deviceCode = decodedText;
                                
                                if (decodedText.includes('/s/')) {
                                    const parts = decodedText.split('/s/');
                                    if (parts.length > 1) {
                                        deviceCode = parts[1]; 
                                    }
                                }

                                window.location.href = '/device/connect/' + encodeURIComponent(deviceCode);
                            });
                        },
                        (errorMessage) => { }
                    ).catch(err => {
                        console.error("Camera failed", err);
                        alert("Gagal mengakses kamera. Izinkan akses di browser.");
                    });
                }
            }
        }
    </script>
</x-app-layout>