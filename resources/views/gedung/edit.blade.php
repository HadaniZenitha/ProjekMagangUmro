@extends('layouts.dashboard')

@section('title', 'Edit Gedung')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Gedung</h5>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('gedung.update', $gedung->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Gedung</label>
                <input type="text"
                       name="kode_gedung"
                       value="{{ old('kode_gedung', $gedung->kode_gedung) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Gedung</label>
                <input type="text"
                       name="nama_gedung"
                       value="{{ old('nama_gedung', $gedung->nama_gedung) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $gedung->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$gedung->is_active ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('gedung.index') }}" class="btn btn-danger">
                     Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection