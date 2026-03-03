@extends('layouts.dashboard')

@section('title', 'Edit Sub Jenis Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Sub Jenis Barang</h5>
    <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">
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

        <form method="POST" action="{{ route('subjenis.update', $subjenis->id) }}">
            @csrf
            @method('PUT')

            <!-- Jenis Barang -->
            <div class="mb-3">
                <label class="form-label">Jenis Barang</label>
                <select name="jenis_barang_id" class="form-select" required>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}"
                            {{ $subjenis->jenis_barang_id == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Sub Jenis -->
            <div class="mb-3">
                <label class="form-label">Nama Sub Jenis</label>
                <input type="text"
                       name="nama_subjenis"
                       value="{{ old('nama_subjenis', $subjenis->nama_subjenis) }}"
                       class="form-control"
                       required>
            </div>

            <!-- Deskripsi -->
            <div class="mb-4">
                <label class="form-label">Deskripsi</label>
                <textarea name="deskripsi"
                          class="form-control"
                          rows="3">{{ old('deskripsi', $subjenis->deskripsi) }}</textarea>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('subjenis.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection