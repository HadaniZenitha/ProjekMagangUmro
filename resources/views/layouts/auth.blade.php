<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pageTitle ?? 'i-Noni' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
@php
    $isLogin = ($mode ?? 'login') === 'login';
@endphp
<body class="min-h-screen bg-[linear-gradient(to_right,#e2e8f0,#bae6fd)] antialiased">
    <main class="mx-auto flex min-h-screen w-full max-w-6xl items-center justify-center px-4 py-8 sm:px-6 lg:px-8">
        <section id="authPanel" class="relative grid min-h-[560px] w-full max-w-5xl overflow-hidden rounded-3xl bg-white shadow-2xl lg:grid-cols-2">
            <div class="{{ $isLogin ? 'lg:order-1' : 'lg:order-2' }} relative overflow-hidden bg-[linear-gradient(to_bottom_right,#0d9488,#0891b2)] px-10 py-12 text-white {{ $isLogin ? 'hidden lg:flex' : 'flex' }} lg:flex-col lg:justify-center">
                <div class="absolute -right-24 -top-24 h-64 w-64 rounded-full bg-white/10"></div>
                <div class="absolute -bottom-24 -left-20 h-72 w-72 rounded-full bg-white/10"></div>

                <div class="relative z-10">
                    <div class="mb-10 inline-flex items-center gap-3 rounded-xl bg-white/10 px-4 py-3">
                        <img src="{{ asset('images/icon.png') }}" alt="PLN" class="h-10 w-10 object-contain">
                        <div>
                            <p class="text-[11px] font-semibold tracking-widest">PLN</p>
                            <p class="text-sm font-bold">NUSANTARA POWER</p>
                        </div>
                    </div>

                    <h1 class="text-4xl font-extrabold leading-tight">{{ $isLogin ? 'SMART UMRO' : 'SMART UMRO' }}</h1>
                    <p class="mt-3 text-white/90">{{ $isLogin ? 'Belum punya akun? Silakan daftar untuk melanjutkan ke sistem i-Noni.' : 'Sudah punya akun? Masuk sekarang untuk melanjutkan aktivitas Anda.' }}</p>

                    @if ($isLogin && Route::has('register'))
                        <!-- <a href="{{ route('register') }}" data-auth-switch="register" class="mt-8 inline-flex h-11 items-center justify-center rounded-lg border-2 border-white px-7 text-sm font-semibold text-white transition hover:bg-white hover:text-teal-700">
                            Register
                        </a> -->
                    @elseif (! $isLogin)
                        <!-- <a href="{{ route('login') }}" data-auth-switch="login" class="mt-8 inline-flex h-11 items-center justify-center rounded-lg border-2 border-white px-7 text-sm font-semibold text-white transition hover:bg-white hover:text-teal-700">
                            Login
                        </a> -->
                    @endif
                </div>
            </div>

            <div class="{{ $isLogin ? 'lg:order-2' : 'lg:order-1' }} flex items-center justify-center px-6 py-10 sm:px-10">
                <div class="w-full max-w-md">
                    <!-- <div class="mb-8 flex items-center gap-2 rounded-xl bg-slate-100 p-1.5">
                        <a href="{{ route('login') }}" data-auth-switch="login" class="flex-1 rounded-lg px-4 py-2.5 text-center text-sm font-semibold transition {{ $isLogin ? 'bg-white text-teal-700 shadow' : 'text-slate-600 hover:bg-white/70' }}">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" data-auth-switch="register" class="flex-1 rounded-lg px-4 py-2.5 text-center text-sm font-semibold transition {{ $isLogin ? 'text-slate-600 hover:bg-white/70' : 'bg-white text-teal-700 shadow' }}">Register</a>
                        @endif
                    </div> -->

                    <h2 class="mb-2 text-3xl font-bold text-slate-900">{{ $formTitle ?? 'Auth' }}</h2>
                    <p class="mb-8 text-sm text-slate-500">{{ $formSubtitle ?? '' }}</p>

                    @yield('auth-form')
                </div>
            </div>
        </section>
    </main>

    <script>
        const authPanel = document.getElementById('authPanel');
        const authLinks = document.querySelectorAll('[data-auth-switch]');
        const lastTransition = sessionStorage.getItem('authSwitch');

        if (authPanel) {
            authPanel.classList.add('transition-all', 'duration-300', 'ease-out');
            if (lastTransition === 'to-login') authPanel.classList.add('opacity-0', '-translate-x-6');
            if (lastTransition === 'to-register') authPanel.classList.add('opacity-0', 'translate-x-6');
            requestAnimationFrame(() => authPanel.classList.remove('opacity-0', '-translate-x-6', 'translate-x-6'));
        }

        authLinks.forEach((link) => {
            link.addEventListener('click', function (event) {
                const target = link.getAttribute('data-auth-switch');
                const href = link.getAttribute('href');

                if (!href || (target === 'login' && window.location.pathname.includes('/login')) || (target === 'register' && window.location.pathname.includes('/register'))) {
                    return;
                }

                event.preventDefault();
                sessionStorage.setItem('authSwitch', target === 'register' ? 'to-register' : 'to-login');
                if (authPanel) authPanel.classList.add('opacity-0', target === 'register' ? '-translate-x-6' : 'translate-x-6');
                setTimeout(() => { window.location.href = href; }, 180);
            });
        });

        sessionStorage.removeItem('authSwitch');

        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', function () {
                const selector = button.getAttribute('data-toggle-password');
                const input = selector ? document.querySelector(selector) : null;
                if (!input) return;

                const isHidden = input.type === 'password';
                input.type = isHidden ? 'text' : 'password';
                
                const svg = button.querySelector('svg');
                if (svg) {
                    svg.innerHTML = isHidden 
                        ? '<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />'
                        : '<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            });
        });
    </script>
</body>
</html>