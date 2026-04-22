@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')

<style>
:root{
    --bg-sidebar: #309FB0;
    --pln-yellow: #FACC15;
    --pln-red: #ef4444;
    --text-dark: #1F3A56;
}

/* CARD */
.custom-card{
    border-radius:16px;
    background:#ffffff;
    padding:28px;
    border:none;
    box-shadow:0 8px 24px rgba(0,0,0,0.06);
}

/* TITLE */
.page-title{
    font-size:20px;
    font-weight:600;
    color:var(--text-dark);
}

/* INPUT */
.form-control{
    border-radius:10px;
    padding:10px 12px;
    border:1px solid #e5e7eb;
}

.form-control:focus{
    border-color:var(--bg-sidebar);
    box-shadow:0 0 0 2px rgba(48,159,176,0.15);
}

/* BUTTON BASE */
.btn-clean{
    border-radius:10px;
    font-weight:500;
    padding:8px 16px;
    border:none;
    box-shadow:none;
}

/* UPDATE */
.btn-warning.btn-clean{
    background:var(--pln-yellow);
    color:#000;
}

/* BATAL */
.btn-danger.btn-clean{
    background:var(--pln-red);
    color:#fff;
}

/* NO HOVER */
.btn-clean:hover{
    background:inherit;
    transform:none;
}

/* ALERT */
.alert-info{
    background:#eef9fb;
    border:none;
    color:var(--text-dark);
}

/* MOBILE */
@media (max-width:768px){
    .btn-mobile-full{
        width:100%;
    }
}
</style>

<!-- HEADER -->
<div class="mb-4">
    <div class="page-title">
        <i class="fa-solid fa-user-edit me-2"></i>
        Edit User
    </div>
</div>

<div class="custom-card">

    <form action="{{ route('users.update', $user) }}" method="POST" id="editUserForm">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-8">

                <!-- NID -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">NID Karyawan</label>
                    <input type="text"
                        class="form-control @error('nid') is-invalid @enderror"
                        id="nid"
                        name="nid"
                        value="{{ old('nid', $user->nid) }}"
                        required
                        placeholder="Contoh: 7503018JA">

                    <div id="nid-loading" class="mt-2 text-muted d-none">
                        <i class="fa-solid fa-spinner fa-spin me-1"></i>
                        Mencari data...
                    </div>

                    <div id="nid-error" class="text-danger small mt-1 d-none"></div>
                </div>

                <!-- NAMA -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama</label>
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        value="{{ old('name', $user->name) }}"
                        readonly>
                </div>

                <!-- DIVISI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Fungsi</label>
                    <input type="text"
                        class="form-control"
                        id="divisi"
                        readonly
                        placeholder="Auto-fill dari NID">
                </div>

                <!-- ROLE -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Role</label>
                    <select class="form-control @error('role') is-invalid @enderror"
                        name="role"
                        required>

                        <option value="">-- Pilih Role --</option>

                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}"
                                {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ ucfirst(str_replace('tim', 'Tim ', $role->name)) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- INFO -->
                <div class="alert alert-info small mb-4">
                    <i class="fa-solid fa-info-circle me-2"></i>
                    <strong>Catatan:</strong> 
                    Password akan otomatis di-generate dari NID yang Anda input. 
                    Jika ingin mengubah NID, data nama dan bidang akan otomatis terupdate.
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-warning btn-clean btn-mobile-full">
                        <i class="fa-solid fa-save me-1"></i> Update
                    </button>

                    <a href="{{ route('users.index') }}"
                        class="btn btn-danger btn-clean btn-mobile-full">
                        Batal
                    </a>
                </div>

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

    if (!nid) return;

    loading.classList.remove('d-none');
    errorDisplay.classList.add('d-none');

    fetch(`{{ route('register.getNidData') }}?nid=${encodeURIComponent(nid)}`)
        .then(res => res.json())
        .then(data => {
            loading.classList.add('d-none');

            if(data.success){
                nameInput.value = data.name;
                divisiInput.value = data.divisi;
            }else{
                nameInput.value = '';
                divisiInput.value = '';
                errorDisplay.textContent = data.error;
                errorDisplay.classList.remove('d-none');
            }
        })
        .catch(() => {
            loading.classList.add('d-none');
            errorDisplay.textContent = 'Terjadi kesalahan saat mengambil data';
            errorDisplay.classList.remove('d-none');
        });
});

// VALIDASI
document.getElementById('editUserForm').addEventListener('submit', function(e){
    if(!document.getElementById('name').value){
        e.preventDefault();
        alert('Silakan isi NID terlebih dahulu');
        document.getElementById('nid').focus();
    }
});
</script>

@endsection