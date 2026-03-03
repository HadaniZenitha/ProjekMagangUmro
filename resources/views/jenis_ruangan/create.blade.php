@extends('layouts.dashboard')

@section('title', 'Tambah Jenis Ruangan')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Jenis Ruangan</h5>
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
    <div class="card-body">

        <form action="{{ route('jenis-ruangan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Jenis Ruangan</label>
                <input type="text"
                       name="kode_jenis_ruangan"
                       class="form-control"
                       placeholder="Contoh: TL"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Jenis Ruangan</label>
                <input type="text"
                       name="nama_jenis_ruangan"
                       class="form-control"
                       placeholder="Contoh: Toilet"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection