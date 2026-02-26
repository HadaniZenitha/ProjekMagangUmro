@extends('layouts.dashboard')

@section('page-title', 'Edit Jenis Ruangan')

@section('title', 'Edit Jenis Ruangan')

@section('content')

<form action="{{ route('jenis-ruangan.update', $jenis_ruangan->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Kode</label>
        <input type="text" name="kode_jenis_ruangan"
               value="{{ $jenis_ruangan->kode_jenis_ruangan }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nama</label>
        <input type="text" name="nama_jenis_ruangan"
               value="{{ $jenis_ruangan->nama_jenis_ruangan }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ $jenis_ruangan->is_active ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$jenis_ruangan->is_active ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection