@extends('layouts.dashboard')

@section('title', 'Tambah Ruang')
<<<<<<< HEAD
@section('page-title', 'Tambah Ruang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('ruangs.store') }}" method="POST">
            @csrf

            <!-- Lantai -->
            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <select name="lantai_id"
                        class="form-control"
                        required>
                    <option value="">-- Pilih Lantai --</option>
                    @foreach($lantais as $l)
                        <option value="{{ $l->id }}">
                            {{ $l->gedung->kode_gedung }} - {{ $l->kode_lantai }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Jenis Ruangan -->
            <div class="mb-3">
                <label class="form-label">Jenis Ruangan</label>
                <select name="jenis_ruangan_id"
                        class="form-control"
                        required>
                    <option value="">-- Pilih Jenis Ruangan --</option>
                    @foreach($jenisRuangans as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->kode_jenis_ruangan }} - {{ $j->nama_jenis_ruangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Ruang -->
            <div class="mb-3">
                <label class="form-label">Nama Ruang</label>
                <input type="text"
                       name="nama_ruang"
                       class="form-control"
                       placeholder="Contoh: Ruang Rapat 1"
                       required>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content mt-3">

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('ruangs.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

            </div>

        </form>

    </div>
=======

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Ruang</h5>
    <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">
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

        <form action="{{ route('ruangs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <select name="lantai_id" class="form-select" required>
                    <option value="">-- Pilih Lantai --</option>
                    @foreach($lantais as $l)
                        <option value="{{ $l->id }}">
                            {{ $l->gedung->kode_gedung }} - {{ $l->kode_lantai }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Ruangan</label>
                <select name="jenis_ruangan_id" class="form-select" required>
                    <option value="">-- Pilih Jenis --</option>
                    @foreach($jenisRuangans as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->kode_jenis_ruangan }} - {{ $j->nama_jenis_ruangan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Ruang</label>
                <input type="text"
                       name="nama_ruang"
                       class="form-control"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('ruangs.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
</div>

@endsection