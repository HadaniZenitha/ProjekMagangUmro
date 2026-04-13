@extends('layouts.dashboard')

@section('title', 'Edit User')

@section('content')
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
                            id="nid" name="nid" value="{{ old('nid', $user->nid) }}" required autocomplete="off"
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
                        <label for="divisi" class="form-label fw-bold">Bidang</label>
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

                    <!-- BUTTONS -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-save me-2"></i>
                            Update
                        </button>
                        <a href="{{ route('users.index') }}" class="btn btn-secondary">
                            <i class="fa-solid fa-times me-2"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('nid').addEventListener('blur', function() {
    const nid = this.value.trim();
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

    fetch(`/register/get-nid-data?nid=${encodeURIComponent(nid)}`)
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
