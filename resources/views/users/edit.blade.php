@extends('layouts.dashboard')

@section('title', 'Edit User')

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

/* BATAL = MERAH */
.btn-danger.btn-clean{
    background-color:#ef4444;
    border:none;
    color:#fff;
}

.btn-danger.btn-clean:hover{
    background-color:#dc2626;
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
        Edit User
    </h5>

</div>

<div class="custom-card">

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white fw-bold">
                <i class="fa-solid fa-user-edit me-2"></i>
                Edit User
            </div>
            <div class="card-body">
                <form action="{{ route('users.update', $user) }}" method="POST" id="editUserForm">
                    @csrf
                    @method('PUT')

                    <!-- NID -->
                    <div class="mb-3">
                        <label for="nid" class="form-label fw-bold">NID Karyawan <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nid') is-invalid @enderror" 
                            id="nid" name="nid" value="{{ old('nid', $user->nid) }}" required autocomplete="on"
                            placeholder="Contoh: 7503018JA">
                        <div id="nid-loading" class="mt-2 text-muted d-none">
                            <i class="fa-solid fa-spinner fa-spin me-1"></i>Mencari NID...
                        </div>
                        <div id="nid-error" class="mt-2 text-danger small d-none"></div>
                        @error('nid')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- NAMA -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nama <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                            id="name" name="name" value="{{ old('name', $user->name) }}" required readonly
                            placeholder="Nama Lengkap (Auto-fill dari NID)">
                        @error('name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- BIDANG/DIVISI -->
                    <div class="mb-3">
                        <label for="divisi" class="form-label fw-bold">Fungsi</label>
                        <input type="text" class="form-control" 
                            id="divisi" readonly
                            placeholder="Bidang (Auto-fill dari NID)">
                    </div>

                    <!-- ROLE -->
                    <div class="mb-4">
                        <label for="role" class="form-label fw-bold">Role <span class="text-danger">*</span></label>
                        <select class="form-control @error('role') is-invalid @enderror" 
                            id="role" name="role" required>
                            <option value="">-- Pilih Role --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->name }}" 
                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                    {{ ucfirst(str_replace('tim', 'Tim ', $role->name)) }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- PASSWORD -->
                    <div class="alert alert-info small mb-4">
                        <i class="fa-solid fa-info-circle me-2"></i>
                        <strong>Catatan:</strong> Password akan otomatis di-generate dari NID yang Anda input. Jika ingin mengubah NID, data nama dan bidang akan otomatis terupdate.
                    </div>

                    {{-- BUTTON --}}
                    <div class="d-flex flex-md-row flex-column gap-2">
                        <button type="submit" class="btn btn-warning btn-clean btn-mobile-full">
                            <i class="fa-solid fa-save me-1"></i> Update
                        </button>
            
                        <a href="{{ route('users.index') }}" 
                           class="btn btn-danger btn-clean btn-mobile-full"> Batal
                        </a>
                    </div>
            </div>

            @error('roles')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror
        </div>

        <!-- BUTTON -->

    </form>

</div>

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

// Validasi form sebelum submit
document.getElementById('editUserForm').addEventListener('submit', function(e) {
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
