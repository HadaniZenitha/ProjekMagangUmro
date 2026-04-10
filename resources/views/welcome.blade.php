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

        /* ===== PALET KAMU ===== */
        :root {
            --bg-sidebar: #309FB0;
            --pln-yellow: #FACC15;
            --pln-red: #E57373;
            --menu-bg: #B2D8DB;
            --menu-active: #D1E9EB;
            --text-dark: #1F3A56;
        }

        /* ICON */
        .icon-blue { background: var(--bg-sidebar); }
        .icon-yellow { background: var(--pln-yellow); }
        .icon-red { background: var(--pln-red); }
        .icon-dark { background: var(--text-dark); }

        /* HERO */
        .hero-bg {
            background: linear-gradient(135deg, #1F3A56 0%, #309FB0 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-bg::before {
            content: '';
            position: absolute;
            inset: 0;
            background: url('https://images.unsplash.com/photo-1581091226825-a6a9e8c8e0c3?auto=format&fit=crop&q=80') center/cover;
            opacity: 0.07;
        }

        .fade-in {
            animation: fadeIn 0.7s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* BUTTON */
        .btn-main {
            background: var(--pln-yellow);
            color: var(--text-dark);
            font-weight: 600;
            transition: all 0.25s ease;
        }

        .btn-main:hover {
            transform: translateY(-2px);
            filter: brightness(0.95);
        }

        /* PRELOADER (FIX WARNA + CLEAN) */
        #preloader {
            position: fixed;
            inset: 0;
            background: linear-gradient(135deg, #1F3A56, #309FB0);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.3s ease;
        }

        .loader {
            width: 52px;
            height: 52px;
            border: 4px solid rgba(255,255,255,0.2);
            border-top: 4px solid var(--pln-yellow);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
    </style>
</head>

<body class="antialiased">

<!-- PRELOADER -->
<div id="preloader">
    <div class="text-center">
        <div class="loader mx-auto mb-4"></div>
        <p class="text-white/70 text-sm tracking-widest">MEMUAT SISTEM...</p>
    </div>
</div>

<!-- NAVBAR -->
<nav class="fixed top-0 w-full bg-white/10 backdrop-blur-md border-b border-white/10 z-50">
    <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center">

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/icon.png') }}" class="w-8 h-8">
            <div class="font-bold text-xl text-white">
                SMART<span style="color:var(--pln-yellow)">UMRO</span>
            </div>
        </div>

        <div class="text-white/70 text-sm">
            PT PLN Nusantara Power
        </div>

    </div>
</nav>

<!-- HERO -->
<div class="hero-bg min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-8 pt-24 grid md:grid-cols-2 gap-12 items-center">

        <!-- LEFT -->
        <div class="fade-in space-y-6">

            <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 rounded-full text-sm text-white/80">
                <i class="fas fa-circle text-green-400"></i>
                Sistem Internal Resmi
            </div>

            <h1 class="text-5xl font-bold text-white leading-tight">
                Selamat Datang di<br>
                <span style="color:var(--pln-yellow)">SMART-UMRO</span>
            </h1>

            <p class="text-white/80 max-w-lg">
                Platform terintegrasi untuk pengelolaan aset, sumber daya, dan operasional PLN Nusantara Power secara efisien dan modern.
            </p>

            <button onclick="goToLogin()" class="btn-main px-8 py-4 rounded-xl flex items-center gap-2">
                MASUK SISTEM
                <i class="fas fa-arrow-right"></i>
            </button>

            <div class="flex gap-6 text-sm text-white/70 pt-4">
                <span><i class="fas fa-lock"></i> Aman</span>
                <span><i class="fas fa-clock"></i> Real-time</span>
                <span><i class="fas fa-chart-line"></i> Data</span>
            </div>

        </div>

        <!-- RIGHT -->
        <div class="fade-in hidden md:flex justify-center">
            <div class="bg-white/10 border border-white/20 p-10 rounded-2xl backdrop-blur-md">
                <img src="{{ asset('images/icon.png') }}" class="w-52 opacity-90">
            </div>
        </div>

    </div>
</div>

<!-- FOOTER -->
<footer class="bg-[var(--text-dark)] py-6 text-center text-white/60 text-sm">
    © 2026 PT PLN Nusantara Power • SMART-UMRO System
</footer>

<script>
window.onload = () => {
    setTimeout(() => {
        const loader = document.getElementById("preloader");
        loader.style.opacity = "0";

        setTimeout(() => {
            loader.style.display = "none";
        }, 300);
    }, 300);
};

function goToLogin() {
    const loader = document.getElementById('preloader');
    loader.style.display = 'flex';
    loader.style.opacity = '1';

    setTimeout(() => {
        window.location.href = "{{ route('login') }}";
    }, 500);
}
</script>

</body>
</html>