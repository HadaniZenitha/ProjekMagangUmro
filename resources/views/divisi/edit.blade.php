@extends('layouts.dashboard')

@section('title', 'Edit Fungsi')

@section('content')

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="fw-bold mb-0">Edit Fungsi</h5>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    {{-- Error Validasi --}}
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

            <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Kode Fungsi --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kode Fungsi</label>
                    <input type="text"
                           name="kode_divisi"
                           value="{{ old('kode_divisi', $divisi->kode_divisi) }}"
                           class="form-control"
                           required>
                </div>

                {{-- Nama Fungsi --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Fungsi</label>
                    <input type="text"
                           name="nama_divisi"
                           value="{{ old('nama_divisi', $divisi->nama_divisi) }}"
                           class="form-control"
                           required>
                </div>

                {{-- Status --}}
                <div class="mb-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="is_active" class="form-select" required>
                        <option value="1" {{ $divisi->is_active ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="0" {{ !$divisi->is_active ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>

                {{-- Tombol Aksi --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="fa-solid fa-save me-1"></i> Update
                    </button>
                    <a href="{{ route('divisi.index') }}" class="btn btn-danger">
                        <i class="fa-solid fa-xmark me-1"></i> Batal
                    </a>
                </div>

            </form>

        </div>
    </div>

@endsection