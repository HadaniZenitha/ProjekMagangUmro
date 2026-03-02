@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Divisi</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Divisi</label>
                <input type="text" name="kode_divisi"
                       value="{{ $divisi->kode_divisi }}"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Divisi</label>
                <input type="text" name="nama_divisi"
                       value="{{ $divisi->nama_divisi }}"
                       class="form-control" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $divisi->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$divisi->is_active ? 'selected' : '' }}>Nonaktif</option>
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