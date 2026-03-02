@extends('layouts.dashboard')

@section('page-title', 'Tambah Lantai')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('lantai.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Gedung</label>
                <select name="gedung_id" class="form-select" required>
                    <option value="">-- Pilih Gedung --</option>
                    @foreach($gedungs as $g)
                        <option value="{{ $g->id }}">
                            {{ $g->kode_gedung }} - {{ $g->nama_gedung }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Lantai</label>
                <input type="text"
                       name="kode_lantai"
                       class="form-control"
                       placeholder="Contoh: L1.5 / Basement"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lantai (Opsional)</label>
                <input type="text"
                       name="nama_lantai"
                       class="form-control"
                       placeholder="Contoh: Lantai Tengah">
            </div>

            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('lantai.index') }}" 
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