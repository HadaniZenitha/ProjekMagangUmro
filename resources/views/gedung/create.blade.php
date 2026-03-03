@extends('layouts.dashboard')

@section('title', 'Tambah Gedung')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Gedung</h5>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('gedung.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Gedung</label>
                <input type="text"
                       name="kode_gedung"
                       class="form-control"
                       placeholder="Contoh: SB"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Gedung</label>
                <input type="text"
                       name="nama_gedung"
                       class="form-control"
                       placeholder="Contoh: Smart Building"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('gedung.index') }}" class="btn btn-danger">
                    </i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection