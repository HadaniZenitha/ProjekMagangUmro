@extends('layouts.dashboard')

@section('title', 'Tambah Kelompok Barang')
@section('page-title', 'Tambah Kelompok Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('kelompok.store') }}" method="POST">
            @csrf

            <!-- Nama Kelompok -->
            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <input type="text"
                       name="nama_kelompok"
                       class="form-control"
                       placeholder="Contoh: Elektronik"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan deskripsi kelompok barang"></textarea>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content-between mt-3">

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('kelompok.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

            </div>

        </form>

    </div>
</div>

@endsection