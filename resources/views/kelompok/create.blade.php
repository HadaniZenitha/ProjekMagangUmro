@extends('layouts.dashboard')

@section('title', 'Tambah Kelompok Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Kelompok Barang</h5>
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
    <div class="card-body">

        <form method="POST" action="{{ route('kelompok.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <input type="text" 
                       name="nama_kelompok" 
                       class="form-control" 
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi" 
                          class="form-control" 
                          rows="3"></textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('kelompok.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection