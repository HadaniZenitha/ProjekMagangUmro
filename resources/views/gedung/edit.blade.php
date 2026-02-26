@extends('layouts.dashboard')

@section('title', 'Edit Gedung')
@section('page-title', 'Edit Gedung')

@section('content')

<form action="{{ route('gedung.update', $gedung->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Kode Gedung</label>
        <input type="text" name="kode_gedung"
               value="{{ $gedung->kode_gedung }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Gedung</label>
        <input type="text" name="nama_gedung"
               value="{{ $gedung->nama_gedung }}"
               class="form-control"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ $gedung->is_active ? 'selected' : '' }}>
                Aktif
            </option>
            <option value="0" {{ !$gedung->is_active ? 'selected' : '' }}>
                Nonaktif
            </option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</form>

@endsection
