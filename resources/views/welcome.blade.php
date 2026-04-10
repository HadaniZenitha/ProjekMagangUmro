<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMART-UMRO | PLN Nusantara Power</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .hero-bg {
            background: linear-gradient(135deg, #1F3A56 0%, #2C6E7F 100%);
            position: relative;
            overflow: hidden;
        }
        
        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1581091226825-a6a9e8c8e0c3?ixlib=rb-4.0.3&auto=format&fit=crop&q=80') center/cover;
            opacity: 0.12;
            z-index: 0;
        }

        .fade-in {
            animation: fadeIn 1s ease forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-main {
            background: #FACC15;
            color: #1F3A56;
            transition: all 0.4s ease;
        }
        .btn-main:hover {
            background: #eab308;
            transform: translateY(-4px);
            box-shadow: 0 15px 25px -5px rgba(250, 204, 21, 0.4);
        }

        #preloader {
            position: fixed;
            inset: 0;
            background: #1F3A56;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.6s ease;
        }
    </style>
</head>

<body class="antialiased">

    <!-- PRELOADER -->
    <div id="preloader">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-white/30 border-t-[#FACC15] rounded-full animate-spin mx-auto mb-6"></div>
            <p class="text-white/80 text-sm tracking-[2px] font-medium">MEMUAT SISTEM...</p>
        </div>
    </div>

    <!-- NAVBAR -->
    <nav class="fixed top-0 w-full bg-white/5 backdrop-blur-md border-b border-white/10 z-50">
        <div class="max-w-7xl mx-auto px-8 py-6 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/icon.png') }}" class="w-8 h-8">   <!-- Logo navbar dikecilkan -->
                <div class="font-bold text-2xl tracking-tighter">
                    SMART<span class="text-yellow-400">UMRO</span>
                </div>
            </div>
            <div class="text-white/70 text-sm font-medium">
                PT PLN Nusantara Power
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <div class="hero-bg min-h-screen flex items-center">
        <div class="max-w-7xl mx-auto px-8 pt-20">
            <div class="grid md:grid-cols-2 gap-16 items-center">

                <!-- LEFT SIDE -->
                <div class="fade-in space-y-8">
                    <div class="inline-flex items-center gap-2 px-5 py-2.5 bg-white/10 rounded-full text-sm backdrop-blur-md">
                        <i class="fas fa-circle text-emerald-400 animate-pulse"></i>
                        <span class="font-medium">Sistem Internal Resmi</span>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-bold leading-tight text-white">
                        Selamat Datang di<br>
                        <span class="text-yellow-400">SMART-UMRO</span>
                    </h1>

                    <p class="text-lg text-white/80 max-w-lg leading-relaxed">
                        Platform terintegrasi untuk pengelolaan aset, sumber daya, dan operasional 
                        PLN Nusantara Power yang lebih efisien, transparan, dan modern.
                    </p>

                    <div class="pt-4">
                        <button onclick="goToLogin()" 
                                class="btn-main px-10 py-5 rounded-2xl font-semibold text-lg flex items-center gap-3 group">
                            MASUK KE SISTEM
                            <i class="fas fa-arrow-right transition group-active:translate-x-2"></i>
                        </button>
                    </div>

                    <div class="flex gap-8 text-sm pt-6">
                        <div class="flex items-center gap-2 text-white/70">
                            <i class="fas fa-lock"></i>
                            <span>Keamanan Tinggi</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/70">
                            <i class="fas fa-clock"></i>
                            <span>Real-Time</span>
                        </div>
                        <div class="flex items-center gap-2 text-white/70">
                            <i class="fas fa-chart-line"></i>
                            <span>Berbasis Data</span>
                        </div>
                    </div>
                </div>

                <!-- RIGHT SIDE (Logo kecil) -->
                <div class="fade-in relative hidden md:flex justify-center items-center">
                    <div class="bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl p-8 shadow-2xl">
                        <img src="{{ asset('images/icon.png') }}" 
                             class="w-48 h-48 mx-auto opacity-90">   <!-- Logo utama dikecilkan jadi 48 (sebelumnya full) -->
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="bg-[#1F3A56]/90 py-8 text-center text-white/60 text-sm">
        <div class="max-w-7xl mx-auto px-8">
            © 2026 PT PLN Nusantara Power • SMART-UMRO System<br>
            <span class="text-xs">Confidential • Internal Use Only</span>
        </div>
    </footer>

    <script>
        window.onload = () => {
            setTimeout(() => {
                document.getElementById("preloader").style.opacity = "0";
                setTimeout(() => {
                    document.getElementById("preloader").style.display = "none";
                }, 800);
            }, 600);
        };

        function goToLogin() {
            const preloader = document.getElementById('preloader');
            preloader.style.display = 'flex';
            preloader.style.opacity = '1';
            
            setTimeout(() => {
                window.location.href = "{{ route('login') }}";
            }, 1100);
        }
    </script>
</body>
</html>