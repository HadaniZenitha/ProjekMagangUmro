@extends('layouts.dashboard')

@section('page-title', 'Tambah Sub Jenis Barang')
@section('title', 'Tambah Sub Jenis Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('subjenis.store') }}">
            @csrf

            <!-- Jenis Barang -->
            <div class="mb-3">
                <label class="form-label">Jenis Barang</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-boxes-stacked"></i>
                    </span>
                    <select name="jenis_barang_id" 
                            class="form-select"
                            required>
                        <option value="">-- Pilih Jenis Barang --</option>
                        @foreach($jenisList as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->nama_jenis }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Nama Sub Jenis -->
            <div class="mb-3">
                <label class="form-label">Nama Sub Jenis</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-cube"></i>
                    </span>
                    <input type="text"
                           name="nama_subjenis"
                           class="form-control"
                           placeholder="Contoh: Laptop Gaming"
                           required>
                </div>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('subjenis.index') }}" 
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