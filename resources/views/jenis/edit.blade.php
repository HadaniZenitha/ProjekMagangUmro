@extends('layouts.dashboard')

@section('title', 'Edit Jenis Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Jenis Barang</h5>
    <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
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

        <form method="POST" action="{{ route('jenis.update', $jenis->id) }}">
            @csrf
            @method('PUT')

            <!-- Kelompok -->
            <div class="mb-3">
                <label class="form-label">Kelompok Barang</label>
                <select name="kelompok_barang_id" class="form-select" required>
                    @foreach($kelompoks as $k)
                        <option value="{{ $k->id }}"
                            {{ $jenis->kelompok_barang_id == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelompok }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <input type="text"
                       name="nama_jenis"
                       value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                       class="form-control"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $jenis->deskripsi) }}</textarea>
            </div>

            <!-- Status -->
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $jenis->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$jenis->is_active ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('jenis.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection