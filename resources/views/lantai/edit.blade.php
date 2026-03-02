@extends('layouts.dashboard')

@section('page-title', 'Edit Lantai')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('lantai.update', $lantai->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Gedung</label>
                <select name="gedung_id" class="form-select">
                    @foreach($gedungs as $g)
                        <option value="{{ $g->id }}"
                            {{ old('gedung_id', $lantai->gedung_id) == $g->id ? 'selected' : '' }}>
                            {{ $g->kode_gedung }} - {{ $g->nama_gedung }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Kode Lantai</label>
                <input type="text"
                       name="kode_lantai"
                       value="{{ old('kode_lantai', $lantai->kode_lantai) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Lantai</label>
                <input type="text"
                       name="nama_lantai"
                       value="{{ old('nama_lantai', $lantai->nama_lantai) }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $lantai->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $lantai->is_active) == 0 ? 'selected' : '' }}>
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