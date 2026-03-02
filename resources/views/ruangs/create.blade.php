@extends('layouts.dashboard')

@section('page-title', 'Tambah Ruang')
@section('title', 'Tambah Ruang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('ruangs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Lantai</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-layer-group"></i>
                    </span>
                    <select name="lantai_id" class="form-select" required>
                        <option value="">-- Pilih Lantai --</option>
                        @foreach($lantais as $l)
                            <option value="{{ $l->id }}">
                                {{ $l->gedung->kode_gedung }} -
                                {{ $l->kode_lantai }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Jenis Ruangan</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-door-open"></i>
                    </span>
                    <select name="jenis_ruangan_id" class="form-select" required>
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($jenisRuangans as $j)
                            <option value="{{ $j->id }}">
                                {{ $j->kode_jenis_ruangan }} - 
                                {{ $j->nama_jenis_ruangan }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Ruang</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-building"></i>
                    </span>
                    <input type="text"
                           name="nama_ruang"
                           class="form-control"
                           placeholder="Contoh: Ruang Rapat 1"
                           required>
                </div>
            </div>

            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('ruangs.index') }}" 
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