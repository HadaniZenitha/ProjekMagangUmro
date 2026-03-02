@extends('layouts.dashboard')

@section('title', 'Edit Kelompok Barang')
@section('page-title', 'Edit Kelompok Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('kelompok.update', $kelompok->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Kode Kelompok</label>

                <!-- tampil tapi tidak bisa diedit -->
                <input type="text"
                       class="form-control bg-light"
                       value="{{ $kelompok->kode_kelompok }}"
                       readonly>

                <!-- tetap dikirim -->
                <input type="hidden"
                       name="kode_kelompok"
                       value="{{ $kelompok->kode_kelompok }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Kelompok</label>
                <input type="text"
                       name="nama_kelompok"
                       value="{{ old('nama_kelompok', $kelompok->nama_kelompok) }}"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $kelompok->deskripsi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('kelompok.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection