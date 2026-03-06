@extends('layouts.dashboard')

@section('title', 'Edit Jenis Ruangan')
@section('page-title', 'Edit Jenis Ruangan')

@section('content')

<<<<<<< HEAD
<div class="card shadow-sm">
=======
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Jenis Ruangan</h5>
    <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('jenis-ruangan.update', $jenis_ruangan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Jenis Ruangan</label>
                <input type="text"
                       name="kode_jenis_ruangan"
<<<<<<< HEAD
                       value="{{ old('kode_jenis_ruangan', $jenis_ruangan->kode_jenis_ruangan) }}"
=======
                       value="{{ $jenis_ruangan->kode_jenis_ruangan }}"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Jenis Ruangan</label>
                <input type="text"
                       name="nama_jenis_ruangan"
<<<<<<< HEAD
                       value="{{ old('nama_jenis_ruangan', $jenis_ruangan->nama_jenis_ruangan) }}"
=======
                       value="{{ $jenis_ruangan->nama_jenis_ruangan }}"
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                       class="form-control"
                       required>
            </div>

<<<<<<< HEAD
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $jenis_ruangan->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $jenis_ruangan->is_active) == 0 ? 'selected' : '' }}>
=======
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $jenis_ruangan->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$jenis_ruangan->is_active ? 'selected' : '' }}>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
<<<<<<< HEAD
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('jenis-ruangan.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
=======
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-danger">
                    Batal
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
                </a>
            </div>

        </form>

    </div>
</div>

@endsection