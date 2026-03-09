@extends('layouts.auth', [
    'pageTitle' => 'SMART UMRO - Login',
    'mode' => 'login',
    'formTitle' => 'Login',
    'formSubtitle' => 'Masuk ke akun SMART UMRO Anda.'
])

@section('content')

<style>

body{
    background:#eef2f6;
    font-family: 'Poppins', sans-serif;
}

/* wrapper */
.login-wrapper{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:20px;
}

/* card */
.login-card{
    display:flex;
    width:900px;
    background:white;
    border-radius:8px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,0.15);
}

/* LEFT */
.login-left{
    width:50%;
    background:linear-gradient(180deg,#2aa6b3,#357a88);
    padding:25px;
    color:white;
    position:relative;
}

.pln-header{
    display:flex;
    align-items:center;
    gap:10px;
}

.pln-text h2{
    font-weight:700;
    letter-spacing:8px;
    margin:0;
}

.pln-text span{
    color:#FFD500;
    font-weight:600;
    font-size:14px;
}

.login-illustration{
    margin-top:30px;
}

.login-illustration img{
    width:100%;
}

/* RIGHT */
.login-right{
    width:50%;
    padding:40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}

.welcome-text{
    text-align:center;
    font-weight:700;
    color:#1e3a8a;
    margin-bottom:30px;
    font-size:20px;
}

/* RESPONSIVE */
@media (max-width:768px){

.login-card{
    flex-direction:column;
    width:100%;
}

.login-left{
    width:100%;
}

.login-right{
    width:100%;
}

}

</style>


<div class="login-wrapper">

    <div class="login-card">

        <!-- LEFT SIDE -->
        <div class="login-left">

            <div class="pln-header">
                <img src="{{ asset('images/icon.png') }}" height="40">
                <div class="pln-text">
                    <h2>PLN</h2>
                    <span>NUSANTARA POWER</span>
                </div>
            </div>

            <div class="login-illustration">
                <img src="{{ asset('images/ilustrasi-pln.png') }}">
            </div>

        </div>


        <!-- RIGHT SIDE -->
        <div class="login-right">

            <div class="welcome-text">
                Selamat Datang Kembali!
            </div>


@section('auth-form')
<form method="POST" action="{{ route('login') }}" class="space-y-5">
@csrf

<div>
<label for="email" class="sr-only">Email</label>

<div class="relative">

<span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">

<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

<path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />

</svg>

</span>

<input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email"

class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('email') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">

</div>

@error('email')
<p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
@enderror

</div>


<div>

<label for="password" class="sr-only">Password</label>

<div class="relative">

<span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">

<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

<path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />

</svg>

</span>

<input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password"

class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-12 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('password') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">

<button type="button" data-toggle-password="#password"

class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600">

<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">

<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

<path stroke-linecap="round" stroke-linejoin="round"

d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />

</svg>

</button>

</div>

@error('password')
<p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
@enderror

</div>


<div class="flex items-center pt-1">

<label class="flex items-center gap-2 text-sm text-slate-600">

<input type="checkbox" name="remember" id="remember"

{{ old('remember') ? 'checked' : '' }}

class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-300">

Ingat Saya

</label>

</div>


<button type="submit"

class="mt-6 h-12 w-full rounded-lg bg-yellow-400 text-sm font-bold tracking-wide text-white transition hover:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-yellow-300">

LOGIN

</button>

</form>
@endsection


        </div>

    </div>

</div>

@endsection