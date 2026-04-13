@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')

<style>
/* ===== CARD CLEAN ===== */
.custom-card{
    border-radius:14px;
    background:#ffffff;
    padding:20px;
    border:1px solid #eaeaea;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

/* ===== BUTTON CLEAN ===== */
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

/* ===== WARNA SAMA ===== */
.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}

.btn-warning.btn-clean:hover{
    background-color:#fbbf24;
}

.btn-secondary.btn-clean{
    background-color:#e5e7eb;
    border:none;
    color:#000;
}

/* HOVER */
.btn-clean:hover{
    transform:translateY(-1px);
}

/* INPUT */
.form-control{
    border-radius:8px;
}

/* BATAL = MERAH */
.btn-danger.btn-clean{
    background-color:#ef4444;
    border:none;
    color:#fff;
}

.btn-danger.btn-clean:hover{
    background-color:#dc2626;
}

/* MOBILE */
@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }
}
</style>

<!-- HEADER -->
<div class="mb-3 d-flex flex-md-row flex-column align-items-md-center">
    
    <h5 class="fw-semibold mb-2 mb-md-0">
        Tambah User Baru
    </h5>
    
</div>

<div class="custom-card">

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <!-- NAMA -->
        <div class="mb-3">
            <label class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
            <input type="text" 
                class="form-control @error('name') is-invalid @enderror" 
                name="name" value="{{ old('name') }}" required>

            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- NID -->
        <div class="mb-3">
            <label class="form-label fw-semibold">NID Karyawan <span class="text-danger">*</span></label>
            <input type="text" 
                class="form-control @error('nid') is-invalid @enderror" 
                name="nid" value="{{ old('nid') }}" required 
                placeholder="Contoh: 7503018JA">

            <small class="text-muted d-block mt-2">
                <i class="fa-solid fa-info-circle me-1"></i>
                Password akan otomatis di-generate dari NID yang Anda input
            </small>

            @error('nid')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- ROLES -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Role <span class="text-danger">*</span></label>

            <div class="border rounded p-3" style="background-color:#f9f9f9;">
                @foreach ($roles as $role)
                    <div class="form-check mb-2">
                        <input class="form-check-input" 
                            type="checkbox" 
                            name="roles[]" 
                            value="{{ $role->name }}" 
                            id="role_{{ $role->name }}"
                            {{ in_array($role->name, old('roles', [])) ? 'checked' : '' }}>

                        <label class="form-check-label" for="role_{{ $role->name }}">
                            {{ ucfirst($role->name) }}
                        </label>
                    </div>
                @endforeach
            </div>

            @error('roles')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="d-flex flex-md-row flex-column gap-2">
            <button type="submit" class="btn btn-warning btn-clean btn-mobile-full">
                <i class="fa-solid fa-save me-1"></i> Simpan
            </button>

            <a href="{{ route('users.index') }}" 
               class="btn btn-danger btn-clean btn-mobile-full">Batal
            </a>
        </div>

    </form>

</div>

@endsection