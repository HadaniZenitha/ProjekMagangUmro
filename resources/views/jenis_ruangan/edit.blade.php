@extends('layouts.dashboard')

@section('title', 'Edit Jenis Ruangan')
@section('page-title', 'Edit Jenis Ruangan')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('jenis-ruangan.update', $jenis_ruangan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Jenis Ruangan</label>
                <input type="text"
                       name="kode_jenis_ruangan"
                       value="{{ old('kode_jenis_ruangan', $jenis_ruangan->kode_jenis_ruangan) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Jenis Ruangan</label>
                <input type="text"
                       name="nama_jenis_ruangan"
                       value="{{ old('nama_jenis_ruangan', $jenis_ruangan->nama_jenis_ruangan) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $jenis_ruangan->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $jenis_ruangan->is_active) == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('jenis-ruangan.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection