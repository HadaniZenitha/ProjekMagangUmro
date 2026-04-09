@extends('layouts.auth', [
    'pageTitle' => 'i-Noni - Login',
    'mode' => 'login',
    'formTitle' => 'Login',
    'formSubtitle' => 'Masuk ke akun i-Noni Anda.'
])

@section('auth-form')
    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <div>
            <label for="nid" class="sr-only">NID Karyawan</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-5m-4-6l4 4m0 0l4-4m-4 4v12" />
                    </svg>
                </span>
                <input id="nid" type="text" name="nid" value="{{ old('nid') }}" required autocomplete="off" autofocus placeholder="NID Karyawan" class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('nid') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">
            </div>
            @error('nid')
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
                <input id="password" type="password" name="password" required autocomplete="current-password" placeholder="Password" class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-12 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('password') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">
                <button type="button" data-toggle-password="#password" class="absolute inset-y-0 right-3 flex items-center text-slate-400 transition hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @error('password')
                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center pt-1">
            <label class="flex items-center gap-2 text-sm text-slate-600">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-teal-600 focus:ring-teal-300">
                Ingat Saya
            </label>
        </div>

        <button type="submit" class="mt-6! h-12 w-full rounded-lg bg-teal-600 text-sm font-bold tracking-wide text-white transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-300">
            LOGIN
        </button>
    </form>
@endsection
