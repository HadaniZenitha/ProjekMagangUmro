@extends('layouts.dashboard')

@section('page-title', 'Tambah Jenis Barang')
@section('title', 'Tambah Jenis Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('jenis.store') }}">
            @csrf

            <!-- Kelompok Barang -->
            <div class="mb-3">
                <label class="form-label">Kelompok Barang</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <select name="kelompok_barang_id" 
                            class="form-select"
                            required>
                        <option value="">-- Pilih Kelompok --</option>
                        @foreach($kelompoks as $k)
                            <option value="{{ $k->id }}">
                                {{ $k->nama_kelompok }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nama Jenis -->
            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-box"></i>
                    </span>
                    <input type="text"
                           name="nama_jenis"
                           class="form-control"
                           placeholder="Contoh: Laptop"
                           required>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-align-left"></i>
                    </span>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"
                              placeholder="Masukkan deskripsi jenis barang"></textarea>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('jenis.index') }}" 
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