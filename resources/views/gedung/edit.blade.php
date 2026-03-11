@extends('layouts.dashboard')

@section('title', 'Tambah Gedung')
@section('page-title', 'Tambah Gedung')

@section('content')

<<<<<<< HEAD
<div class="mb-4">
    <h5 class="fw-bold mb-0">Tambah Gedung</h5>
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Gedung</h5>
    <a href="{{ route('gedung.index') }}">
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
    <div class="card-body">

        <form action="{{ route('gedung.store') }}" method="POST">
            @csrf

            <!-- Kode Gedung -->
            <div class="mb-3">
                <label class="form-label">Kode Gedung</label>
                <input type="text"
                       name="kode_gedung"
                       value="{{ old('kode_gedung') }}"
                       class="form-control"
                       placeholder="Contoh: SB"
                       required>
            </div>

            <!-- Nama Gedung -->
            <div class="mb-3">
                <label class="form-label">Nama Gedung</label>
                <input type="text"
                       name="nama_gedung"
                       value="{{ old('nama_gedung') }}"
                       class="form-control"
                       placeholder="Contoh: Smart Building"
                       required>
            </div>

<<<<<<< HEAD
            <!-- Status -->
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ old('is_active', 1) ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ old('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
=======
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $gedung->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$gedung->is_active ? 'selected' : '' }}>
                        Nonaktif
                    </option>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
                </select>
            </div>

            <div class="d-flex gap-2">
<<<<<<< HEAD
                <button type="submit" class="btn btn-warning">
=======
                <button class="btn btn-warning">
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('gedung.index') }}" class="btn btn-danger">
<<<<<<< HEAD
                    <i class="fa-solid fa-xmark me-1"></i> X Batal
=======
                     Batal
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
                </a>
            </div>

        </form>

    </div>
</div>

@endsection