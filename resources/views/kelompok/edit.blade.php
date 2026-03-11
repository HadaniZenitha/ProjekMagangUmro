@extends('layouts.dashboard')

@section('title', 'Edit Kelompok Barang')
@section('page-title', 'Edit Kelompok Barang')

@section('content')

<<<<<<< HEAD
<div class="mb-4">
    <h5 class="fw-bold mb-0">Edit Kelompok Barang</h5>
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Kelompok Barang</h5>
    <a href="{{ route('kelompok.index') }}">
    </a>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
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
<<<<<<< HEAD
<div class="card-body">
=======
    <div class="card-body">
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

<form action="{{ route('kelompok.update', $kelompok->id) }}" method="POST">
@csrf
@method('PUT')

<!-- Kode (Readonly) -->
<div class="mb-3">
<label class="form-label">Kode Kelompok</label>

<<<<<<< HEAD
<input type="text"
       class="form-control"
       value="{{ $kelompok->kode_kelompok }}"
       readonly>

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
=======
                <input type="text"
                       class="form-control"
                       value="{{ $kelompok->kode_kelompok }}"
                       readonly>

                <input type="hidden"
                       name="kode_kelompok"
                       value="{{ $kelompok->kode_kelompok }}">
            </div>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

<!-- Deskripsi -->
<div class="mb-4">
<label class="form-label">Deskripsi</label>
<textarea name="deskripsi"
          class="form-control"
          rows="3">{{ old('deskripsi', $kelompok->deskripsi) }}</textarea>
</div>

<<<<<<< HEAD
<div class="d-flex gap-2">

<button type="submit" class="btn btn-warning">
<i class="fa-solid fa-save me-1"></i> Update
</button>

<a href="{{ route('kelompok.index') }}" class="btn btn-danger">
<i class="fa-solid fa-xmark me-1"></i> Batal
</a>

</div>
=======
            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $kelompok->deskripsi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('kelompok.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

</form>

</div>
</div>

@endsection