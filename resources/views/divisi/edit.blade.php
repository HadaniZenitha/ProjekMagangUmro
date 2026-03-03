@extends('layouts.dashboard')

@section('title', 'Edit Divisi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Divisi</h5>
    <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Divisi</label>
                <input type="text"
                       name="kode_divisi"
                       value="{{ old('kode_divisi', $divisi->kode_divisi) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Divisi</label>
                <input type="text"
                       name="nama_divisi"
                       value="{{ old('nama_divisi', $divisi->nama_divisi) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $divisi->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$divisi->is_active ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>
                <a href="{{ route('divisi.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection