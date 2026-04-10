<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMART-UMRO | PLN Nusantara Power</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;800&display=swap');
        
        body { 
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fafafa;
        }

        .brand-text {
            letter-spacing: -0.05em;
        }

        .fade-in {
            animation: fadeIn 1.2s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Warna spesifik sesuai permintaan */
        .bg-pln { background-color: #00818c; }
        .text-pln-blue { color: #00549b; }    /* Biru PLN */
        .text-pln-yellow { color: #ffce00; }  /* Kuning Nusantara Power */
        .text-pln-teal { color: #00818c; }
    </style>
</head>
<body class="antialiased">

    <div class="relative min-h-screen flex flex-col justify-center items-center px-6 overflow-hidden">
        
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-teal-50 rounded-full blur-[120px] opacity-60"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-yellow-50 rounded-full blur-[100px] opacity-60"></div>

        <div class="max-w-4xl w-full text-center z-10 fade-in">
            
            <div class="flex flex-col items-center mb-10">
                <div class="mb-6 shadow-2xl shadow-teal-100 transition-transform hover:scale-105">
                    <img src="{{ asset('images/icon.png') }}" alt="Logo PLN NP" class="w-20 h-20 object-contain rounded-2xl">
                </div>

                <div class="flex flex-col items-center">
                    <h3 class="text-2xl font-black tracking-tighter text-pln-blue uppercase">PLN</h3>
                    <p class="text-[11px] font-bold tracking-[0.4em] text-pln-yellow uppercase mt-1">Nusantara Power</p>
                </div>
                <div class="h-[1px] w-12 bg-gray-200 mt-6"></div>
            </div>

            <h1 class="brand-text text-5xl lg:text-7xl font-extrabold text-slate-900 mb-6 leading-[1.1]">
                Smart Management of Assets <br> 
                <span class="text-pln-teal">& Resource Terintegrasi.</span>
            </h1>

            <h2 class="text-2xl font-semibold text-slate-400 tracking-tighter mb-12 uppercase">
                U M R O
            </h2>

            <div class="flex flex-col items-center gap-6">
                <a href="{{ route('login') }}" 
                   class="group relative inline-flex items-center justify-center px-12 py-5 font-bold text-white transition-all duration-200 bg-pln rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-900 shadow-xl hover:bg-slate-800">
                    <span class="mr-3">Masuk ke Dashboard</span>
                    <svg class="w-5 h-5 transition-all duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
                
                <p class="text-sm text-gray-400 font-medium italic">
                    "Smart Management of Assets and Resource Terintegrasi UMRO"
                </p>
            </div>
        </div>

        <footer class="absolute bottom-10 w-full text-center">
            <div class="flex justify-center gap-8 text-[10px] font-bold text-gray-300 tracking-widest uppercase">
                <span>Versi 1.0.0</span>
                <span>•</span>
                <span>System Secure</span>
                <span>•</span>
                <span>2026</span>
            </div>
        </footer>
    </div>

</body>
</html>