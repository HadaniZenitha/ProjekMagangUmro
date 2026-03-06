@extends('layouts.dashboard')

@section('title', 'Edit Kelompok Barang')
@section('page-title', 'Edit Kelompok Barang')

@section('content')

<<<<<<< HEAD
<div class="card shadow-sm">
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Kelompok Barang</h5>
    <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
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
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
    <div class="card-body">

        <form action="{{ route('kelompok.update', $kelompok->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Kode (Readonly) -->
            <div class="mb-3">
                <label class="form-label">Kode Kelompok</label>

                <input type="text"
<<<<<<< HEAD
                       class="form-control bg-light"
                       value="{{ $kelompok->kode_kelompok }}"
                       readonly>

                <!-- tetap dikirim -->
=======
                       class="form-control"
                       value="{{ $kelompok->kode_kelompok }}"
                       readonly>

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                <input type="hidden"
                       name="kode_kelompok"
                       value="{{ $kelompok->kode_kelompok }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <input type="text"
                       name="nama_kelompok"
                       value="{{ old('nama_kelompok', $kelompok->nama_kelompok) }}"
                       class="form-control"
                       required>
            </div>

<<<<<<< HEAD
            <div class="mb-3">
=======
            <!-- Deskripsi -->
            <div class="mb-4">
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $kelompok->deskripsi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
<<<<<<< HEAD
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('kelompok.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
=======
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('kelompok.index') }}" class="btn btn-danger">
                    Batal
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                </a>
            </div>

        </form>

    </div>
</div>

@endsection