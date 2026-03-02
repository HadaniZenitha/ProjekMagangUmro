@extends('layouts.dashboard')

@section('page-title', 'Tambah Kelompok Barang')
@section('title', 'Tambah Kelompok Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('kelompok.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <input type="text"
                           name="nama_kelompok"
                           class="form-control"
                           placeholder="Contoh: Elektronik"
                           required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-align-left"></i>
                    </span>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"
                              placeholder="Masukkan deskripsi kelompok barang"></textarea>
                </div>
            </div>

            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('kelompok.index') }}" 
                   class="btn btn-warning me-2 shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection