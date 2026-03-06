@extends('layouts.dashboard')

@section('title', 'Tambah Gedung')

@section('content')

<<<<<<< HEAD
<div class="card shadow-sm">
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Gedung</h5>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
    <div class="card-body">

        <form action="{{ route('gedung.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Gedung</label>
<<<<<<< HEAD
                <input type="text" name="kode_gedung"
=======
                <input type="text"
                       name="kode_gedung"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                       class="form-control"
                       placeholder="Contoh: SB"
                       required>
            </div>

<<<<<<< HEAD
            <div class="mb-3">
                <label class="form-label">Nama Gedung</label>
                <input type="text" name="nama_gedung"
=======
            <div class="mb-4">
                <label class="form-label">Nama Gedung</label>
                <input type="text"
                       name="nama_gedung"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                       class="form-control"
                       placeholder="Contoh: Smart Building"
                       required>
            </div>

<<<<<<< HEAD
            <div class="d-flex left-content-between mt-3">

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('gedung.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

=======
            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('gedung.index') }}" class="btn btn-danger">
                    </i> Batal
                </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
            </div>

        </form>

    </div>
</div>

@endsection