@extends('layouts.dashboard')

@section('title', 'Tambah Ruang')
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
</div>

@endsection