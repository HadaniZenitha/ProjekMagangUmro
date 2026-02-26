@extends('layouts.dashboard')

@section('title', 'Edit Kelompok Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('kelompok.update', $kelompok->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Kelompok</label>

                <!-- tampil tapi tidak bisa diedit -->
                <input type="text"
                        class="form-control"
                        value="{{ $kelompok->kode_kelompok }}"
                        readonly>

                <!-- dikirim ke server -->
                <input type="hidden"
                        name="kode_kelompok"
                        value="{{ $kelompok->kode_kelompok }}">
            </div>

            <!-- Nama -->
            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <input type="text"
                       name="nama_kelompok"
                       value="{{ old('nama_kelompok', $kelompok->nama_kelompok) }}"
                       class="form-control"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $kelompok->deskripsi) }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>

            <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">
                Batal
            </a>

        </form>

    </div>
</div>
@endsection
