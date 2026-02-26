@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Edit Divisi</h2>

    <form action="{{ route('divisi.update', $divisi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode Divisi</label>
            <input type="text" name="kode_divisi"
                   value="{{ $divisi->kode_divisi }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Divisi</label>
            <input type="text" name="nama_divisi"
                   value="{{ $divisi->nama_divisi }}"
                   class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="is_active" class="form-control">
                <option value="1" {{ $divisi->is_active ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ !$divisi->is_active ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button class="btn btn-primary">Update</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
