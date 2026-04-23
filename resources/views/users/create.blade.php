@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah User</h5>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="nid" class="form-label fw-semibold">NID Karyawan <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('nid') is-invalid @enderror"
                        id="nid"
                        name="nid"
                        value="{{ old('nid') }}"
                        required
                        autocomplete="off"
                        placeholder="Contoh: 7503018JA">
                    <div id="nid-loading" class="mt-2 text-muted d-none">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>Mencari NID...
                    </div>
                    <div id="nid-error" class="mt-2 text-danger small d-none"></div>
                    @error('nid')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                    <input type="text"
                        class="form-control @error('name') is-invalid @enderror"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        readonly
                        placeholder="Nama Lengkap (Auto-fill dari NID)">
                    @error('name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="divisi" class="form-label fw-semibold">Bidang</label>
                    <input type="text"
                        class="form-control"
                        id="divisi"
                        readonly
                        placeholder="Bidang (Auto-fill dari NID)">
                </div>

                <div class="col-md-6 mb-4">
                    <label for="role" class="form-label fw-semibold">Role <span class="text-danger">*</span></label>
                    <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                        <option value="">-- Pilih Role --</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('tim', 'Tim ', $role->name)) }}
                            </option>
                        @endforeach
                    </select>
                    @error('role')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="alert alert-info small mb-4">
                <i class="fa-solid fa-info-circle me-2"></i>
                <strong>Catatan:</strong> Password akan otomatis di-generate dari NID yang Anda input
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('users.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

            @error('roles')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const nidInput = document.getElementById('nid');
    const createUserForm = document.getElementById('createUserForm');

    nidInput.addEventListener('blur', function() {
        const nid = this.value.trim().toUpperCase();
        this.value = nid;
        const loading = document.getElementById('nid-loading');
        const nameInput = document.getElementById('name');
        const divisiInput = document.getElementById('divisi');
        const errorDisplay = document.getElementById('nid-error');

        if (!nid) {
            nameInput.value = '';
            divisiInput.value = '';
            errorDisplay.classList.add('d-none');
            return;
        }

        loading.classList.remove('d-none');
        errorDisplay.classList.add('d-none');

        fetch(`{{ route('register.getNidData') }}?nid=${encodeURIComponent(nid)}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                loading.classList.add('d-none');

                if (data.error) {
                    nameInput.value = '';
                    divisiInput.value = '';
                    errorDisplay.textContent = data.error;
                    errorDisplay.classList.remove('d-none');
                } else if (data.success) {
                    nameInput.value = data.name;
                    divisiInput.value = data.divisi;
                    errorDisplay.classList.add('d-none');
                }
            })
            .catch(error => {
                loading.classList.add('d-none');
                console.error('Error:', error);
                nameInput.value = '';
                divisiInput.value = '';
                errorDisplay.textContent = 'Terjadi kesalahan saat mengambil data NID';
                errorDisplay.classList.remove('d-none');
            });
    });

    createUserForm.addEventListener('submit', function(e) {
        const nameInput = document.getElementById('name');
        if (!nameInput.value.trim()) {
            e.preventDefault();
            alert('Silakan isi NID terlebih dahulu dan tunggu nama auto-fill');
            nidInput.focus();
        }
    });
});
</script>

@endsection