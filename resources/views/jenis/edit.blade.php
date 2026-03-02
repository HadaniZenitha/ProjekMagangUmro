@extends('layouts.dashboard')

@section('title', 'Edit Jenis Barang')
@section('page-title', 'Edit Jenis Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('jenis.update', $jenis->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kelompok Barang</label>
                <select name="kelompok_barang_id" class="form-select" required>
                    @foreach($kelompoks as $k)
                        <option value="{{ $k->id }}"
                            {{ old('kelompok_barang_id', $jenis->kelompok_barang_id) == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kelompok }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Jenis</label>
                <input type="text"
                       name="nama_jenis"
                       value="{{ old('nama_jenis', $jenis->nama_jenis) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $jenis->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1"
                        {{ old('is_active', $jenis->is_active) == 1 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0"
                        {{ old('is_active', $jenis->is_active) == 0 ? 'selected' : '' }}>
                        Nonaktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('jenis.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection