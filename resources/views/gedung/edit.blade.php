@extends('layouts.dashboard')

@section('title', 'Edit Gedung')
@section('page-title', 'Edit Gedung')

@section('content')

<div class="card shadow-sm">
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

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $gedung->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $gedung->is_active) == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('divisi.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection