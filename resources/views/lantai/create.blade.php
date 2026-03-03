@extends('layouts.dashboard')

@section('title', 'Tambah Lantai')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Lantai</h5>
    <a href="{{ route('lantai.index') }}" class="btn btn-secondary">
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

            <div class="mb-4">
                <label class="form-label">Nama Lantai (Opsional)</label>
                <input type="text"
                       name="nama_lantai"
                       class="form-control"
                       placeholder="Contoh: Lantai Tengah">
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('lantai.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection