@extends('layouts.dashboard')

@section('title', 'Tambah Jenis Barang')
@section('page-title', 'Tambah Jenis Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('jenis.store') }}" method="POST">
            @csrf

            <!-- Kelompok Barang -->
            <div class="mb-3">
                <label class="form-label">Kelompok Barang</label>
                <select name="kelompok_barang_id"
                        class="form-control"
                        required>
                    <option value="">-- Pilih Kelompok --</option>
                    @foreach($kelompoks as $k)
                        <option value="{{ $k->id }}">
                            {{ $k->nama_kelompok }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Jenis -->
            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <input type="text"
                       name="nama_jenis"
                       class="form-control"
                       placeholder="Contoh: Laptop"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3"
                          placeholder="Masukkan deskripsi jenis barang"></textarea>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content-between mt-3">

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('jenis.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

            </div>

        </form>

    </div>
</div>

@endsection