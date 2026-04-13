@extends('layouts.auth', [
    'pageTitle' => 'i-Noni - Register',
    'mode' => 'register',
    'formTitle' => 'Registration',
    'formSubtitle' => 'Buat akun baru untuk menggunakan i-Noni.'
])

@section('auth-form')
    <form method="POST" action="{{ route('register') }}" class="space-y-5" id="registerForm">
        @csrf

        <!-- NID -->
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
            <p id="nid-loading" class="mt-2 text-xs text-slate-500 hidden">
                <i class="fa-solid fa-spinner fa-spin me-1"></i>Mencari NID...
            </p>
            <p id="nid-error" class="mt-1 text-xs font-medium text-red-500 hidden"></p>
        </div>

        <!-- NAMA -->
        <div>
            <label for="name" class="sr-only">Nama Lengkap</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Nama Lengkap (Auto-fill dari NID)" readonly class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('name') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">
            </div>
            @error('name')
                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- BIDANG/DIVISI -->
        <div>
            <label for="divisi" class="sr-only">Bidang</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z" />
                    </svg>
                </span>
                <input id="divisi" type="text" placeholder="Bidang (Auto-fill dari NID)" readonly class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 cursor-not-allowed">
            </div>
        </div>

        <!-- ROLE -->
        <div>
            <label for="role" class="sr-only">Role</label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-slate-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </span>
                <select id="role" name="role" required class="h-12 w-full rounded-lg border bg-slate-100 pl-11 pr-4 text-sm text-slate-800 placeholder:text-slate-400 focus:border-teal-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-teal-200 {{ $errors->has('role') ? 'border-red-400 ring-2 ring-red-300' : 'border-transparent' }}">
                    <option value="">-- Pilih Role --</option>
                    <option value="superadmin" {{ old('role') == 'superadmin' ? 'selected' : '' }}>Superadmin</option>
                    <option value="timinventarisasi" {{ old('role') == 'timinventarisasi' ? 'selected' : '' }}>Tim Inventarisasi</option>
                </select>
            </div>
            @error('role')
                <p class="mt-1 text-xs font-medium text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- KETERANGAN -->
        <div class="rounded-lg bg-teal-50 p-3 border border-teal-200">
            <p class="text-xs text-teal-800">
                <i class="fa-solid fa-info-circle me-2"></i>
                <strong>Catatan:</strong> Password akan otomatis di-generate dari NID Anda
            </p>
        </div>

        <button type="submit" class="mt-6! h-12 w-full rounded-lg bg-teal-600 text-sm font-bold tracking-wide text-white transition hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-300">
            REGISTER
        </button>
    </form>

    <script>
        document.getElementById('nid').addEventListener('blur', function() {
            const nid = this.value.trim().toUpperCase();
            this.value = nid;
            const loading = document.getElementById('nid-loading');
            const nameInput = document.getElementById('name');
            const divisiInput = document.getElementById('divisi');
            const errorDisplay = document.getElementById('nid-error');
            
            if (!nid) {
                nameInput.value = '';
                divisiInput.value = '';
                errorDisplay.classList.add('hidden');
                return;
            }

            loading.classList.remove('hidden');
            errorDisplay.classList.add('hidden');

            fetch(`{{ route('register.getNidData') }}?nid=${encodeURIComponent(nid)}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    loading.classList.add('hidden');
                    
                    if (data.error) {
                        nameInput.value = '';
                        divisiInput.value = '';
                        errorDisplay.textContent = data.error;
                        errorDisplay.classList.remove('hidden');
                    } else if (data.success) {
                        nameInput.value = data.name;
                        divisiInput.value = data.divisi;
                        errorDisplay.classList.add('hidden');
                    }
                })
                .catch(error => {
                    loading.classList.add('hidden');
                    console.error('Error:', error);
                    nameInput.value = '';
                    divisiInput.value = '';
                    errorDisplay.textContent = 'Terjadi kesalahan saat mengambil data NID. Cek console untuk detail.';
                    errorDisplay.classList.remove('hidden');
                });
        });

        // Validasi form sebelum submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            const nameInput = document.getElementById('name');
            if (!nameInput.value.trim()) {
                e.preventDefault();
                alert('Silakan isi NID terlebih dahulu dan tunggu nama auto-fill');
                document.getElementById('nid').focus();
                return false;
            }
        });
    </script>
@endsection
