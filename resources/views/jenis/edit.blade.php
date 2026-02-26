@extends('layouts.dashboard')

@section('title', 'Edit Jenis Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('jenis.update', $jenis->id) }}">
            @csrf
            @method('PUT')

            <!-- Kelompok -->
            <div class="mb-3">
                <label class="form-label">Kelompok Barang</label>
                <select name="kelompok_barang_id" class="form-control" required>
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
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1" {{ $jenis->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$jenis->is_active ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <button class="btn btn-primary">Update</button>

            <a href="{{ route('jenis.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>

    </div>
</div>
@endsection
