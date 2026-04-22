@extends('layouts.dashboard')

@section('title', 'Tambah User')

@section('content')

<style>
:root{
    --bg-sidebar: #309FB0;
    --pln-yellow: #FACC15;
    --pln-red: #E57373;
    --menu-bg: #B2D8DB;
    --menu-active: #D1E9EB;
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

/* HEADER */
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

/* BUTTON */
.btn-clean{
    border-radius:10px;
    font-weight:500;
    padding:8px 16px;
    transition:all 0.2s ease;
}

/* SIMPAN */
.btn-warning.btn-clean{
    background:var(--pln-yellow);
    border:none;
    color:#000;
}

.btn-warning.btn-clean:hover{
    background:#fbbf24;
}

/* BATAL (MERAH TANPA HOVER) */
.btn-danger.btn-clean{
    background:#ef4444;
    border:none;
    color:#fff;
    box-shadow:none;
}

/* MATIKAN SEMUA EFEK HOVER */
.btn-danger.btn-clean:hover{
    background:#ef4444;
    transform:none;
}

/* ALERT */
.alert-info{
    background:#eef9fb;
    border:none;
    color:#1F3A56;
}

/* LOADING TEXT */
#nid-loading{
    font-size:13px;
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
        <i class="fa-solid fa-user-plus me-2"></i>
        Tambah User Baru
    </div>
</div>

<div class="custom-card">

    <form action="{{ route('users.store') }}" method="POST" id="createUserForm">
        @csrf

        <div class="row">

            <!-- LEFT -->
            <div class="col-md-8">

                <!-- NID -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">NID Karyawan</label>
                    <input type="text"
                        class="form-control @error('nid') is-invalid @enderror"
                        id="nid"
                        name="nid"
                        value="{{ old('nid') }}"
                        placeholder="Contoh: 7503018JA"
                        required>

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
                        readonly
                        placeholder="Auto-fill dari NID">
                </div>

                <!-- DIVISI -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Bidang</label>
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
                            <option value="{{ $role->name }}">
                                {{ ucfirst(str_replace('tim', 'Tim ', $role->name)) }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <!-- INFO -->
                <div class="alert alert-info small mb-4">
                    Password otomatis dibuat dari NID
                </div>

                <!-- BUTTON -->
                <div class="d-flex gap-2 flex-wrap">
                    <button type="submit" class="btn btn-warning btn-clean btn-mobile-full">
                        <i class="fa-solid fa-save me-1"></i> Simpan
                    </button>

                    <a href="{{ route('users.index') }}"
                        class="btn btn-danger btn-clean btn-mobile-full">
                        Batal
                    </a>
                </div>

            </div>

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

    fetch(`{{ route('register.getNidData') }}?nid=${nid}`)
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
            errorDisplay.textContent = 'Terjadi kesalahan';
            errorDisplay.classList.remove('d-none');
        });
});

// VALIDASI
document.getElementById('createUserForm').addEventListener('submit', function(e){
    if(!document.getElementById('name').value){
        e.preventDefault();
        alert('Isi NID dulu ya');
    }
});
</script>

@endsection