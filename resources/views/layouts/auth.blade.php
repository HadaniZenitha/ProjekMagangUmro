<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>{{ $pageTitle ?? 'i-Noni' }}</title>

<script src="https://cdn.tailwindcss.com"></script>

<style>

body{
background: linear-gradient(120deg,#cbd5f5,#b6e3f4);
}

/* overlay agar teks tetap terbaca */
.overlay{
background:linear-gradient(
to bottom,
rgba(0,0,0,0.35),
rgba(0,0,0,0.55)
);
}

/* panel form premium */
.glass{
background:rgba(255,255,255,0.9);
backdrop-filter:blur(12px);
}

/* animasi input */
.input-style{
transition:all .25s ease;
}

.input-style:focus{
box-shadow:0 0 0 2px #14b8a6;
background:#fff;
}

</style>

</head>

@php
$isLogin = ($mode ?? 'login') === 'login';
@endphp

<body class="min-h-screen flex items-center justify-center p-4">

<main class="w-full max-w-6xl">

<section
class="grid overflow-hidden rounded-3xl shadow-2xl
lg:grid-cols-2 bg-white">

<!-- PANEL GAMBAR -->
<div
class="{{ $isLogin ? 'lg:order-1' : 'lg:order-2' }}
relative text-white flex flex-col justify-between
px-10 py-12 overflow-hidden"

style="background-image:url('{{ asset('images/smart-umro.png') }}');
background-size:cover;
background-position:center;">

<!-- overlay -->
<div class="absolute inset-0 overlay"></div>

<div class="relative z-10 flex flex-col justify-between h-full">

<!-- LOGO PLN -->
<div class="inline-flex items-center gap-3
bg-white/15 px-4 py-3 rounded-xl backdrop-blur w-fit">

<img src="{{ asset('images/icon.png') }}" class="h-10 w-10">

<div>
<p class="text-xs font-semibold tracking-widest">
PLN
</p>

<p class="font-bold text-sm">
NUSANTARA POWER
</p>
</div>

</div>

<!-- TEKS SMART UMRO -->
<div class="max-w-sm">

<h1 class="text-4xl font-extrabold leading-tight">
SMART UMRO
</h1>

<p class="mt-3 text-white/90 text-sm sm:text-base">
Smart Management of Assets and Resources Terintegrasi UMRO
</p>

</div>

</div>

</div>


<!-- PANEL FORM -->
<div
class="{{ $isLogin ? 'lg:order-2' : 'lg:order-1' }}
flex items-center justify-center
px-6 py-12 sm:px-10">

<div class="glass w-full max-w-md
p-8 rounded-2xl shadow-lg">

<h2 class="text-3xl font-bold text-slate-800">
{{ $formTitle ?? 'Login' }}
</h2>

<p class="text-sm text-slate-500 mt-1 mb-8">
{{ $formSubtitle ?? 'Masuk ke akun i-Noni Anda' }}
</p>

@yield('auth-form')

</div>

</div>

</section>

</main>

<script>

document.querySelectorAll('[data-toggle-password]').forEach((button)=>{

button.addEventListener('click',function(){

const selector=button.getAttribute('data-toggle-password')
const input=document.querySelector(selector)

if(!input)return

if(input.type==='password'){
input.type='text'
}else{
input.type='password'
}

})

})

</script>

</body>
</html>