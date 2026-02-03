<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Nusantaramu - Smart Waste Smart Future | SMK Muhammadiyah Kudus</title>
    <meta name="description" content="Platform IoT inovatif karya SMK Muhammadiyah Kudus. Mengubah sampah botol dan cup plastik menjadi saldo digital dan sedekah jariyah.">
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['"Plus Jakarta Sans"', 'sans-serif'] },
                    colors: {
                        emerald: { 50:'#ecfdf5', 100:'#d1fae5', 200:'#a7f3d0', 300:'#6ee7b7', 400:'#34d399', 500:'#10b981', 600:'#059669', 700:'#047857', 800:'#065f46', 900:'#064e3b' },
                        slate: { 850: '#1e293b', 900: '#0f172a' }
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: { '0%, 100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-20px)' } },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        }
                    }
                }
            }
        }
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>

    <style>
        html { scroll-behavior: smooth; }
        body { -webkit-font-smoothing: antialiased; }
        
        /* Glassmorphism */
        .glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }
        
        /* Gradient Text */
        .text-gradient {
            background: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hero Animation: Liquid Blobs */
        .hero-blob-container { position: absolute; inset: 0; overflow: hidden; z-index: 0; pointer-events: none; }
        .blob { position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.5; animation: blob-bounce 10s infinite ease-in-out alternate; }
        .blob-1 { top: -10%; right: -10%; width: 700px; height: 700px; background: #d1fae5; }
        .blob-2 { bottom: -10%; left: -10%; width: 600px; height: 600px; background: #ccfbf1; animation-delay: 2s; }
        .blob-3 { top: 40%; left: 40%; width: 400px; height: 400px; background: #e0f2fe; animation-delay: 4s; opacity: 0.3; }
        @keyframes blob-bounce { 0% { transform: translate(0, 0) scale(1); } 100% { transform: translate(30px, -30px) scale(1.1); } }

        /* Line Animation (Cara Kerja) */
        .process-line-bg {
            position: absolute; top: 60px; left: 16%; width: 68%; height: 4px;
            background-color: #f1f5f9; border-radius: 99px; z-index: 0; overflow: hidden;
        }
        .process-line-fill {
            height: 100%; width: 0%; 
            background: linear-gradient(90deg, #34d399, #059669);
            transition: width 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        #how-it-works:hover .process-line-fill { width: 100%; }

        /* Grid Pattern */
        .bg-grid {
            background-size: 40px 40px;
            background-image: linear-gradient(to right, rgba(226, 232, 240, 0.5) 1px, transparent 1px),
                              linear-gradient(to bottom, rgba(226, 232, 240, 0.5) 1px, transparent 1px);
        }

        /* Hover Card Effects */
        .feature-card { transition: all 0.4s ease; }
        .feature-card:hover { transform: translateY(-8px); box-shadow: 0 20px 40px -5px rgba(16, 185, 129, 0.1); border-color: #6ee7b7; }

        /* FAQ Smooth Transition */
        .faq-content {
            transition: max-height 0.4s ease-in-out, opacity 0.4s ease-in-out;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }
        .faq-content.open {
            opacity: 1;
        }

        /* Loader & Scrollbar */
        #loader { transition: opacity 0.6s ease, visibility 0.6s ease; }
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f8fafc; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 5px; border: 2px solid #f8fafc; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }
        
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-slate-50 text-slate-600 antialiased overflow-x-hidden selection:bg-emerald-200 selection:text-emerald-900" 
      x-data="{ 
          scrolled: false, 
          mobileMenu: false,
          activeArticle: null,
          articles: [
            {
                id: 1,
                title: 'Bahaya Microplastic bagi Tubuh',
                category: 'Tips',
                image: 'https://images.unsplash.com/photo-1611284446314-60a58ac0deb9?q=80&w=800',
                content: 'Plastik yang terbuang ke alam tidak benar-benar hilang, melainkan terurai menjadi partikel kecil yang disebut mikroplastik. Partikel ini dapat masuk ke sumber air, ikan, dan akhirnya ke tubuh manusia. Studi terbaru menunjukkan mikroplastik dapat mengganggu sistem hormon dan pencernaan. Dengan memilah sampah di Nusantaramu, kamu mencegah siklus berbahaya ini.'
            },
            {
                id: 2,
                title: 'Teknologi di Balik Nusantaramu',
                category: 'Teknologi',
                image: 'https://images.unsplash.com/photo-1518770660439-4636190af475?q=80&w=800',
                content: 'Alat IoT kami menggunakan kombinasi sensor Load Cell untuk berat dan ESP32-CAM untuk visi komputer. Ketika kamu memasukkan botol, AI akan memindai bentuk objek dalam milidetik. Jika valid, sistem mengirim sinyal ke server untuk menambahkan poin ke akunmu secara realtime. Ini adalah penerapan Industry 4.0 di lingkungan sekolah.'
            },
            {
                id: 3,
                title: 'SMK Muhammadiyah Kudus Go Green',
                category: 'Inspirasi',
                image: 'https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=800',
                content: 'Sebagai sekolah pusat keunggulan, SMK Muhammadiyah Kudus berkomitmen menciptakan lingkungan belajar yang asri. Program Smart Waste ini adalah langkah nyata mengurangi jejak karbon sekolah hingga 40% dalam satu tahun. Partisipasi siswa adalah kunci keberhasilan gerakan ini.'
            }
          ]
      }" 
      @scroll.window="scrolled = (window.pageYOffset > 20)">

    <div id="loader" class="fixed inset-0 z-[100] bg-white flex items-center justify-center">
        <div class="flex flex-col items-center gap-4">
            <div class="relative w-20 h-20">
                <div class="absolute inset-0 border-4 border-emerald-100 rounded-full"></div>
                <div class="absolute inset-0 border-4 border-emerald-500 rounded-full border-t-transparent animate-spin"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <img src="{{ asset('img/logo.png') }}" class="w-8 h-8 object-contain opacity-90" alt="Loader">
                </div>
            </div>
            <p class="text-xs font-bold text-emerald-600 tracking-[0.3em] animate-pulse">NUSANTARAMU</p>
        </div>
    </div>

    <header :class="scrolled ? 'bg-white/90 backdrop-blur-md shadow-sm border-slate-200/50' : 'bg-transparent border-transparent'" 
            class="fixed w-full z-50 transition-all duration-500 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 md:h-24">
                
                <a href="#" class="flex items-center gap-3 group" onclick="window.scrollTo(0,0)">
                    <div class="w-11 h-11 bg-gradient-to-tr from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform duration-300 border border-white/20">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo Nusantaramu" class="w-7 h-7 object-contain brightness-0 invert">
                    </div>
                    <div class="flex flex-col">
                        <span class="text-xl font-extrabold text-slate-900 leading-none tracking-tight font-sans group-hover:text-emerald-600 transition-colors">NUSANTARAMU</span>
                        <span class="text-[10px] font-bold text-emerald-600 tracking-[0.1em] uppercase mt-0.5">Smart Waste Smart Future</span>
                        <span class="text-[8px] text-slate-400 font-medium tracking-wide">Karya SMK Muhammadiyah Kudus</span>
                    </div>
                </a>

                <nav class="hidden lg:flex items-center gap-2 bg-white/50 p-1.5 rounded-full border border-slate-200/50 backdrop-blur-sm shadow-sm" id="desktop-nav">
                    <a href="#home" class="nav-link relative px-5 py-2 rounded-full text-xs font-bold transition-all duration-300">
                        Beranda
                    </a>
                    <a href="#about" class="nav-link relative px-5 py-2 rounded-full text-xs font-medium transition-all duration-300">
                        Tentang
                    </a>
                    <a href="#features" class="nav-link relative px-5 py-2 rounded-full text-xs font-medium transition-all duration-300">
                        Teknologi
                    </a>
                    <a href="#how-it-works" class="nav-link relative px-5 py-2 rounded-full text-xs font-medium transition-all duration-300">
                        Cara Kerja
                    </a>
                    <a href="#contact" class="nav-link relative px-5 py-2 rounded-full text-xs font-medium transition-all duration-300">
                        Kontak
                    </a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden md:flex items-center gap-2 px-6 py-2.5 text-xs font-bold text-white bg-slate-900 rounded-full hover:bg-emerald-600 transition shadow-lg hover:shadow-emerald-500/30 transform hover:-translate-y-0.5">
                            <i class="fa-solid fa-gauge-high"></i> Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="hidden md:inline-block text-xs font-bold text-slate-600 hover:text-emerald-600 transition px-4">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="group relative px-6 py-2.5 rounded-full bg-emerald-600 text-white text-xs font-bold overflow-hidden shadow-lg hover:shadow-emerald-500/30 transition-all hover:-translate-y-0.5">
                            <span class="relative z-10 flex items-center gap-2">
                                Daftar <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-teal-400 opacity-0 group-hover:opacity-100 transition duration-300"></div>
                        </a>
                    @endauth

                    <button @click="mobileMenu = !mobileMenu" class="lg:hidden p-2 text-slate-600 hover:text-emerald-600 transition">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-5"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-5"
             class="lg:hidden absolute top-20 left-0 w-full bg-white border-b border-slate-100 shadow-xl py-6 px-6 flex flex-col gap-4 z-40"
             @click.outside="mobileMenu = false"
             x-cloak>
            <a href="#home" @click="mobileMenu = false" class="text-sm font-bold text-emerald-600">Beranda</a>
            <a href="#about" @click="mobileMenu = false" class="text-sm font-medium text-slate-600">Tentang</a>
            <a href="#features" @click="mobileMenu = false" class="text-sm font-medium text-slate-600">Teknologi</a>
            <a href="#how-it-works" @click="mobileMenu = false" class="text-sm font-medium text-slate-600">Cara Kerja</a>
            <a href="#contact" @click="mobileMenu = false" class="text-sm font-medium text-slate-600">Kontak Kami</a>
            <hr class="border-slate-100">
            <div class="flex gap-4 pt-2">
                <a href="{{ route('login') }}" class="flex-1 py-3 text-center text-sm font-bold border border-slate-200 rounded-xl text-slate-700 hover:bg-slate-50">Masuk</a>
                <a href="{{ route('register') }}" class="flex-1 py-3 text-center text-sm font-bold bg-emerald-600 text-white rounded-xl hover:bg-emerald-700">Daftar</a>
            </div>
        </div>
    </header>

    <section id="home" class="relative pt-36 pb-20 lg:pt-48 lg:pb-32 overflow-hidden bg-white min-h-screen flex items-center">
        <div class="hero-blob-container">
            <div class="blob blob-1"></div>
            <div class="blob blob-2"></div>
            <div class="blob blob-3"></div>
        </div>
        <div class="absolute inset-0 bg-white/30 backdrop-blur-[1px]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="flex flex-col lg:flex-row items-center gap-12 lg:gap-20">
                
                <div class="w-full lg:w-1/2 text-center lg:text-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/80 border border-emerald-100 shadow-sm mb-8 animate-float cursor-default backdrop-blur-md">
                        <span class="relative flex h-3 w-3">
                          <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                          <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                        </span>
                        <span class="text-[11px] font-bold text-slate-600 uppercase tracking-widest">Inovasi Lingkungan 2026</span>
                    </div>

                    <h1 class="text-5xl sm:text-6xl lg:text-7xl font-extrabold text-slate-900 tracking-tight leading-[1.1] mb-6">
                        Ubah Sampah Jadi <br class="hidden lg:block">
                        <span class="text-gradient">Kebaikan Nyata</span>
                    </h1>
                    
                    <p class="text-lg text-slate-500 mb-10 leading-relaxed max-w-lg mx-auto lg:mx-0 font-medium">
                        Platform IoT pintar dari <strong>SMK Muhammadiyah Kudus</strong>. Kami membantu sekolah memilah sampah botol dan cup plastik menjadi saldo digital secara otomatis.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto h-14 px-8 rounded-full bg-slate-900 text-white font-bold text-sm shadow-xl hover:bg-slate-800 hover:scale-105 transition duration-300 flex items-center justify-center gap-3 group">
                            <span>Mulai Sekarang</span>
                            <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                        </a>
                        <a href="#how-it-works" class="w-full sm:w-auto h-14 px-8 rounded-full bg-white text-slate-700 border border-slate-200 font-bold text-sm hover:border-emerald-500 hover:text-emerald-600 hover:shadow-md transition duration-300 flex items-center justify-center gap-3 group">
                            <span class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-play text-xs"></i>
                            </span>
                            Cara Kerja
                        </a>
                    </div>

                    <div class="mt-12 flex items-center justify-center lg:justify-start gap-8 border-t border-slate-200/60 pt-8">
                        <div>
                            <p class="text-3xl font-extrabold text-slate-900">1.2K+</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Siswa Aktif</p>
                        </div>
                        <div class="w-px h-10 bg-slate-200"></div>
                        <div>
                            <p class="text-3xl font-extrabold text-emerald-600">5 Ton</p>
                            <p class="text-[10px] text-slate-500 font-bold uppercase tracking-wider">Sampah Terpilah</p>
                        </div>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 relative flex justify-center z-10" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                    <div class="relative w-full max-w-[500px]">
                        <img src="{{ asset('img/hero.png') }}" 
                             alt="Siswa SMK Inovator" 
                             class="relative z-10 w-full h-auto object-contain drop-shadow-2xl animate-float"
                             style="filter: drop-shadow(0 20px 40px rgba(16, 185, 129, 0.2));">

                        <div class="absolute top-20 -left-4 z-20 animate-float-delayed glass p-3 rounded-2xl shadow-xl border-l-4 border-emerald-500 flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 text-lg"><i class="fa-solid fa-wifi"></i></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Koneksi</p>
                                <p class="text-sm font-extrabold text-slate-900">IoT Online</p>
                            </div>
                        </div>
                        <div class="absolute bottom-1/2 -right-6 z-20 animate-float glass p-4 rounded-full shadow-xl">
                             <div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-2xl text-white shadow-inner"><i class="fa-solid fa-recycle fa-spin-pulse" style="--fa-animation-duration: 3s;"></i></div>
                        </div>
                        <div class="absolute bottom-16 left-0 z-20 animate-float-delayed glass p-3 rounded-2xl shadow-xl flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-lg"><i class="fa-solid fa-wallet"></i></div>
                            <div>
                                <p class="text-[10px] font-bold text-slate-400 uppercase">Saldo Poin</p>
                                <p class="text-sm font-extrabold text-slate-900">Rp 50.000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-12 border-y border-slate-100 bg-white/60 backdrop-blur-sm">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-8">Didukung Ekosistem Pendidikan & Sosial</p>
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-24 opacity-80">
                <img src="{{ asset('img/lazismu.png') }}" class="h-10 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-500 hover:scale-110" alt="Lazismu">
                <img src="{{ asset('img/pemkab.png') }}" class="h-12 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-500 hover:scale-110" alt="Pemkab Kudus">
                <img src="{{ asset('img/smk.png') }}" class="h-10 w-auto object-contain grayscale hover:grayscale-0 transition-all duration-500 hover:scale-110" alt="SMK Muhammadiyah Kudus">
            </div>
        </div>
    </section>

    <section id="about" class="py-24 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                
                <div data-aos="fade-right">
                    <span class="text-emerald-600 font-bold tracking-widest uppercase text-xs pl-4 border-l-4 border-emerald-500">Latar Belakang</span>
                    <h2 class="mt-6 text-3xl md:text-4xl font-extrabold text-slate-900 mb-8 leading-tight">
                        Mengapa Sekolah Perlu <br>
                        <span class="text-gradient">Smart Waste System?</span>
                    </h2>
                    
                    <div class="space-y-8">
                        <div class="flex gap-5 group">
                            <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center flex-shrink-0 text-red-600 shadow-sm group-hover:bg-red-200 transition-colors">
                                <i class="fa-solid fa-bottle-droplet text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Sampah Plastik Menumpuk</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mt-2">
                                    Sekolah menghasilkan ratusan botol dan cup plastik setiap hari. Tanpa pemilahan, sampah ini mencemari lingkungan sekolah.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-5 group">
                            <div class="w-14 h-14 rounded-2xl bg-orange-100 flex items-center justify-center flex-shrink-0 text-orange-600 shadow-sm group-hover:bg-orange-200 transition-colors">
                                <i class="fa-solid fa-file-pen text-2xl"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-900">Bank Sampah Manual Tidak Efisien</h3>
                                <p class="text-slate-500 text-sm leading-relaxed mt-2">
                                    Pencatatan manual membuat siswa malas karena antre dan prosesnya lambat. Dibutuhkan sistem digital yang memberi reward instan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="relative group" data-aos="fade-left">
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-200 to-teal-100 rounded-[3rem] transform rotate-3 scale-105 opacity-50 group-hover:rotate-1 transition duration-500"></div>
                    <img src="{{ asset('img/sampah-indonesia.png') }}" 
                         alt="Tumpukan Sampah" 
                         class="relative w-full h-[450px] object-cover rounded-[3rem] shadow-2xl border-4 border-white z-10 transform group-hover:-translate-y-2 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-24 bg-white relative overflow-hidden">
        <div class="absolute inset-0 bg-grid opacity-50 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
                <span class="bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider">Teknologi Terintegrasi</span>
                <h2 class="mt-6 text-3xl md:text-4xl font-extrabold text-slate-900">Ekosistem Smart Waste</h2>
                <p class="mt-4 text-slate-500 text-lg">Perpaduan hardware presisi dan aplikasi cerdas untuk efisiensi maksimal.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-6 h-auto md:h-[700px]">
                
                <div class="md:col-span-2 md:row-span-2 bg-slate-50 rounded-[2.5rem] p-10 border border-slate-200 shadow-sm hover:shadow-2xl hover:border-emerald-200 transition-all duration-500 relative overflow-hidden group" data-aos="zoom-in" data-aos-delay="100">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-emerald-100 rounded-full blur-[80px] opacity-0 group-hover:opacity-100 transition duration-700"></div>
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-8 border border-slate-100 shadow-sm group-hover:bg-emerald-500 group-hover:text-white transition-colors duration-300">
                            <i class="fa-solid fa-eye text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-900 mb-4">AI-Powered Vision</h3>
                        <p class="text-slate-500 leading-relaxed mb-auto">
                            Menggunakan modul kamera <strong>ESP32-CAM</strong> yang ditenagai model <em>Machine Learning (TinyML)</em>. Alat ini dapat mengenali bentuk visual botol PET, cup plastik, dan kaleng alumunium secara real-time.
                        </p>
                        <div class="mt-8 bg-white p-6 rounded-3xl border border-slate-100">
                            <div class="flex justify-between text-xs font-bold mb-2 text-slate-600"><span>Akurasi Model</span><span class="text-emerald-600">99.2%</span></div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                                <div class="bg-emerald-500 h-2.5 rounded-full w-[99%] shadow-[0_0_10px_#10b981]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 bg-slate-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden group hover:scale-[1.01] transition duration-500 shadow-xl" data-aos="zoom-in" data-aos-delay="200">
                    <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
                    <div class="relative z-10 flex flex-col md:flex-row justify-between items-center h-full gap-6">
                        <div>
                            <div class="w-12 h-12 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center mb-4 text-xl border border-white/10"><i class="fa-solid fa-qrcode"></i></div>
                            <h3 class="text-xl font-bold mb-2">QR Login System</h3>
                            <p class="text-slate-300 text-sm leading-relaxed">Tanpa password yang ribet. Cukup scan kode unik di layar alat IoT menggunakan HP untuk login instan.</p>
                        </div>
                        <i class="fa-solid fa-mobile-screen text-7xl text-slate-700 group-hover:text-emerald-400 transition-colors duration-500 opacity-50 group-hover:opacity-100"></i>
                    </div>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition duration-500 group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-12 h-12 bg-teal-50 rounded-2xl flex items-center justify-center mb-4 text-teal-600 group-hover:bg-teal-500 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-cloud-arrow-up text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Realtime Sync</h3>
                    <p class="text-slate-500 text-sm">Data berat & poin tersinkronisasi detik itu juga ke server cloud.</p>
                </div>

                <div class="bg-white rounded-[2.5rem] p-8 border border-slate-100 shadow-sm hover:shadow-xl transition duration-500 group" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center mb-4 text-blue-600 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-hand-holding-heart text-xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Auto Infaq</h3>
                    <p class="text-slate-500 text-sm">Fitur unggulan untuk mendonasikan poin sampah ke Lazismu.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="how-it-works" class="py-24 bg-slate-50 relative group/section overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20" data-aos="fade-down">
                <span class="text-emerald-600 font-bold tracking-widest uppercase text-xs">Alur Penggunaan</span>
                <h2 class="mt-3 text-3xl font-extrabold text-slate-900">3 Langkah Mudah</h2>
            </div>

            <div class="relative">
                <div class="hidden md:block step-connector">
                    <div class="process-line-bg">
                        <div class="process-line-fill"></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 relative z-10">
                    <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-24 h-24 bg-white rounded-3xl shadow-lg border-4 border-slate-100 flex items-center justify-center mb-8 relative group-hover:scale-110 transition duration-300 group-hover:border-emerald-200 z-10">
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-md">1</div>
                            <i class="fa-solid fa-expand text-3xl text-slate-400 group-hover:text-emerald-600 transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Scan QR</h3>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto">Buka website di HP, lalu scan QR Code di layar alat IoT untuk login.</p>
                    </div>

                    <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-24 h-24 bg-white rounded-3xl shadow-lg border-4 border-slate-100 flex items-center justify-center mb-8 relative group-hover:scale-110 transition duration-300 group-hover:border-emerald-200 z-10">
                             <div class="absolute -top-3 -right-3 w-8 h-8 bg-emerald-500 text-white rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-md">2</div>
                             <i class="fa-solid fa-trash-arrow-up text-3xl text-slate-400 group-hover:text-emerald-600 transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Pilah & Setor</h3>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto">Masukkan Botol atau Cup Plastik ke lubang yang sesuai. Alat mendeteksi otomatis.</p>
                    </div>

                    <div class="flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-24 h-24 bg-white rounded-3xl shadow-lg border-4 border-slate-100 flex items-center justify-center mb-8 relative group-hover:scale-110 transition duration-300 group-hover:border-emerald-200 z-10">
                             <div class="absolute -top-3 -right-3 w-8 h-8 bg-teal-500 text-white rounded-full flex items-center justify-center font-bold text-sm border-2 border-white shadow-md">3</div>
                             <i class="fa-solid fa-coins text-3xl text-slate-400 group-hover:text-emerald-600 transition-colors"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Terima Poin</h3>
                        <p class="text-slate-500 text-sm max-w-xs mx-auto">Saldo masuk otomatis ke akunmu. Bisa ditukar uang atau disedekahkan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-end mb-12">
                <div>
                    <span class="text-emerald-600 font-bold tracking-widest uppercase text-xs">Edukasi Lingkungan</span>
                    <h2 class="mt-2 text-3xl font-extrabold text-slate-900">Artikel Pilihan</h2>
                </div>
                <a href="#" class="hidden md:flex items-center gap-2 text-sm font-bold text-emerald-600 hover:text-emerald-700 transition mt-4 md:mt-0">
                    Lihat Semua <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <template x-for="article in articles" :key="article.id">
                    <article class="group cursor-pointer" @click="activeArticle = article">
                        <div class="rounded-3xl overflow-hidden mb-4 relative h-60 w-full">
                            <img :src="article.image" :alt="article.title" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold" 
                                 :class="article.category === 'Tips' ? 'text-emerald-600' : (article.category === 'Teknologi' ? 'text-blue-600' : 'text-orange-600')"
                                 x-text="article.category"></div>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2 group-hover:text-emerald-600 transition" x-text="article.title"></h3>
                        <p class="text-sm text-slate-500 line-clamp-2" x-text="article.content"></p>
                    </article>
                </template>
            </div>
        </div>
    </section>

    <div x-show="activeArticle" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/70 backdrop-blur-sm" x-cloak>
        <div class="bg-white rounded-3xl w-full max-w-2xl max-h-[90vh] overflow-y-auto shadow-2xl relative" @click.outside="activeArticle = null">
            <button @click="activeArticle = null" class="absolute top-4 right-4 bg-white rounded-full p-2 hover:bg-slate-100 z-10 shadow">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>
            <img :src="activeArticle?.image" class="w-full h-64 object-cover">
            <div class="p-8">
                <span class="text-xs font-bold uppercase tracking-wider text-emerald-600" x-text="activeArticle?.category"></span>
                <h2 class="text-2xl font-bold text-slate-900 mt-2 mb-4" x-text="activeArticle?.title"></h2>
                <p class="text-slate-600 leading-relaxed" x-text="activeArticle?.content"></p>
                <p class="text-slate-600 leading-relaxed mt-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
        </div>
    </div>

    <section id="faq" class="py-24 bg-slate-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
             <div class="text-center mb-16" data-aos="zoom-in">
                <span class="text-emerald-600 font-bold tracking-widest uppercase text-xs">Pusat Bantuan</span>
                <h2 class="mt-3 text-3xl font-extrabold text-slate-900">Pertanyaan Umum</h2>
            </div>
            
            <div class="space-y-4" x-data="{ selected: 1 }">
                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden transition-all duration-300 hover:border-emerald-300">
                    <button @click="selected !== 1 ? selected = 1 : selected = null" class="w-full flex justify-between items-center p-6 text-left focus:outline-none bg-slate-50/50 hover:bg-slate-100 transition">
                        <span class="font-bold text-slate-800">Apa saja jenis sampah yang diterima?</span>
                        <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="selected === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div class="faq-content bg-slate-50/30" :class="selected === 1 ? 'open' : ''" :style="selected === 1 ? 'max-height: ' + $el.scrollHeight + 'px' : ''">
                        <div class="px-6 pb-6 pt-2 text-sm text-slate-600 leading-relaxed">
                            <p>Alat IoT Nusantaramu menerima:</p>
                            <ul class="list-disc pl-5 mt-2 space-y-1">
                                <li><strong>Botol Plastik (PET)</strong>: Botol air mineral bening.</li>
                                <li><strong>Cup Plastik</strong>: Gelas minuman ringan (Pastikan kosong & kering).</li>
                                <li><strong>Sampah Organik</strong>: Sisa makanan (Masuk ke lubang khusus organik).</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden transition-all duration-300 hover:border-emerald-300">
                    <button @click="selected !== 2 ? selected = 2 : selected = null" class="w-full flex justify-between items-center p-6 text-left focus:outline-none bg-slate-50/50 hover:bg-slate-100 transition">
                        <span class="font-bold text-slate-800">Bagaimana cara mencairkan saldo?</span>
                        <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="selected === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div class="faq-content bg-slate-50/30" :class="selected === 2 ? 'open' : ''" :style="selected === 2 ? 'max-height: ' + $el.scrollHeight + 'px' : ''">
                        <div class="px-6 pb-6 pt-2 text-sm text-slate-600 leading-relaxed">
                            Login ke dashboard siswa, lalu masuk ke menu <strong>"Tarik Saldo"</strong>. Anda bisa mencairkan poin ke dompet digital (GoPay, Dana, OVO, ShopeePay) dengan minimal penarikan Rp 10.000.
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden transition-all duration-300 hover:border-emerald-300">
                    <button @click="selected !== 3 ? selected = 3 : selected = null" class="w-full flex justify-between items-center p-6 text-left focus:outline-none bg-slate-50/50 hover:bg-slate-100 transition">
                        <span class="font-bold text-slate-800">Bagaimana fitur sedekah bekerja?</span>
                        <i class="fa-solid fa-chevron-down text-slate-400 transition-transform duration-300" :class="selected === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div class="faq-content bg-slate-50/30" :class="selected === 3 ? 'open' : ''" :style="selected === 3 ? 'max-height: ' + $el.scrollHeight + 'px' : ''">
                        <div class="px-6 pb-6 pt-2 text-sm text-slate-600 leading-relaxed">
                            Anda bisa memilih opsi <strong>"Sedekah"</strong> di dashboard. Poin akan dikonversi menjadi dana dan disalurkan ke <strong>Lazismu</strong> untuk program sosial. Laporan penyaluran tersedia transparan di web.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900 mb-6">Hubungi Kami</h2>
                    <p class="text-slate-500 mb-8">Punya pertanyaan tentang alat atau ingin bekerjasama? Kirim pesan kepada tim SMK Muhammadiyah Kudus.</p>
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" placeholder="Nama Lengkap" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                            <input type="email" placeholder="Email" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                        </div>
                        <input type="text" placeholder="Subjek" class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition">
                        <textarea rows="4" placeholder="Pesan Anda..." class="w-full px-4 py-3 rounded-xl border border-slate-200 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition"></textarea>
                        <button class="px-8 py-3 bg-slate-900 text-white font-bold rounded-xl hover:bg-emerald-600 transition shadow-lg w-full md:w-auto">Kirim Pesan</button>
                    </form>
                </div>
                <div class="bg-slate-50 p-8 rounded-3xl shadow-sm border border-slate-100 h-fit">
                    <h3 class="text-xl font-bold text-slate-900 mb-6">Informasi Kontak</h3>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-slate-900 rounded-xl flex items-center justify-center shadow-md">
                            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-6 h-6 object-contain brightness-0 invert">
                        </div>
                        <div>
                            <span class="font-extrabold text-lg text-slate-900 block leading-none font-sans">NUSANTARAMU</span>
                            <span class="text-[10px] font-bold text-emerald-600 uppercase tracking-wider">Smart Waste Smart Future</span>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Alamat Sekolah</p>
                                <p class="text-sm text-slate-500">SMK Muhammadiyah Kudus<br>Jl. Kudus - Jepara KM 3, Prambatan Lor, Kaliwungu, Kudus, Jawa Tengah.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                                <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">Email Resmi</p>
                                <p class="text-sm text-slate-500">admin@nusantaramu.com</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 flex-shrink-0">
                                <i class="fa-brands fa-whatsapp"></i>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-900">WhatsApp Admin</p>
                                <p class="text-sm text-slate-500">0877-1480-2071</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-slate-900 text-white pt-20 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo" class="w-8 h-8 object-contain brightness-0 invert">
                        <div>
                            <span class="font-bold text-xl tracking-tight block leading-none">NUSANTARAMU</span>
                            <span class="text-[10px] text-emerald-400 font-bold tracking-widest uppercase">Smart Waste Smart Future</span>
                        </div>
                    </div>
                    <p class="text-slate-400 text-sm leading-relaxed mb-6">
                        Inovasi teknologi lingkungan dari SMK Muhammadiyah Kudus untuk mewujudkan sekolah hijau dan ekonomi sirkular.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-emerald-500 transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-blue-600 transition"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center hover:bg-red-500 transition"><i class="fa-brands fa-youtube"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-white">Menu</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="#home" class="hover:text-emerald-400 transition">Beranda</a></li>
                        <li><a href="#about" class="hover:text-emerald-400 transition">Tentang</a></li>
                        <li><a href="#features" class="hover:text-emerald-400 transition">Teknologi</a></li>
                        <li><a href="#faq" class="hover:text-emerald-400 transition">Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-white">Legal</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li><a href="#" class="hover:text-emerald-400 transition">Kebijakan Privasi</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Syarat & Ketentuan</a></li>
                        <li><a href="#" class="hover:text-emerald-400 transition">Disclaimer</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6 text-white">Newsletter</h4>
                    <p class="text-xs text-slate-400 mb-4">Dapatkan info terbaru kegiatan Adiwiyata.</p>
                    <form class="flex gap-2">
                        <input type="email" placeholder="Email..." class="bg-slate-800 border-none rounded-lg px-3 py-2 text-sm w-full focus:ring-1 focus:ring-emerald-500 text-white">
                        <button class="bg-emerald-600 px-3 py-2 rounded-lg hover:bg-emerald-700 transition"><i class="fa-solid fa-paper-plane"></i></button>
                    </form>
                </div>
            </div>
            <div class="border-t border-slate-800 pt-8 text-center text-xs text-slate-500">
                &copy; 2026 Nusantaramu Project. Karya SMK Muhammadiyah Kudus.
            </div>
        </div>
    </footer>

    <a href="https://wa.me/6287714802071?text=Halo%20Admin%20Nusantaramu,%20saya%20ingin%20bertanya." 
       target="_blank" 
       class="fixed bottom-8 right-8 z-50 group transition-all hover:-translate-y-1">
        <div class="absolute -top-10 right-0 bg-white px-3 py-1 rounded-lg shadow-md border border-slate-100 opacity-0 group-hover:opacity-100 transition duration-300 text-xs font-bold text-slate-600 w-max pointer-events-none">
            Butuh Bantuan?
        </div>
        <div class="relative w-14 h-14 bg-[#25D366] rounded-full flex items-center justify-center shadow-xl border-4 border-white">
            <i class="fa-brands fa-whatsapp text-white text-2xl"></i>
        </div>
    </a>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Init AOS
        AOS.init({ once: true, offset: 50, duration: 800, easing: 'ease-out-cubic' });

        // Hide Loader
        window.addEventListener('load', () => {
            const loader = document.getElementById('loader');
            loader.style.opacity = '0';
            setTimeout(() => { loader.style.display = 'none'; }, 500);
        });

        // Scroll Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("scroll-progress").style.width = scrolled + "%";
        };

        // ScrollSpy Logic (Animated Pill)
        document.addEventListener('DOMContentLoaded', () => {
            const navLinks = document.querySelectorAll('.nav-link');
            const sections = document.querySelectorAll('section');

            const handleScrollSpy = () => {
                let current = '';
                const scrollY = window.scrollY;
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    // Logic: Aktif jika scroll melewati 1/4 bagian section
                    if (scrollY >= (sectionTop - sectionHeight / 4)) {
                        current = section.getAttribute('id');
                    }
                });

                navLinks.forEach(link => {
                    // Reset State
                    link.classList.remove('bg-emerald-100', 'text-emerald-700', 'shadow-sm');
                    link.classList.add('text-slate-500', 'hover:text-emerald-600');
                    
                    // Active State
                    if (link.getAttribute('href').includes(current)) {
                        link.classList.add('bg-emerald-100', 'text-emerald-700', 'shadow-sm');
                        link.classList.remove('text-slate-500', 'hover:text-emerald-600');
                    }
                });
            };

            window.addEventListener('scroll', handleScrollSpy);
            handleScrollSpy(); // Trigger on load
        });
    </script>
</body>
</html>