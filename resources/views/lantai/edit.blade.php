@extends('layouts.dashboard')

@section('page-title', 'Edit Lantai')

@section('content')

<form action="{{ route('lantai.update', $lantai->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Gedung</label>
        <select name="gedung_id" class="form-control">
            @foreach($gedungs as $g)
                <option value="{{ $g->id }}"
                    {{ $lantai->gedung_id == $g->id ? 'selected' : '' }}>
                    {{ $g->kode_gedung }} - {{ $g->nama_gedung }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kode Lantai</label>
        <input type="text" name="kode_lantai"
               value="{{ $lantai->kode_lantai }}"
               class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nama Lantai</label>
        <input type="text" name="nama_lantai"
               value="{{ $lantai->nama_lantai }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Status</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ $lantai->is_active ? 'selected' : '' }}>Aktif</option>
            <option value="0" {{ !$lantai->is_active ? 'selected' : '' }}>Nonaktif</option>
        </select>
    </div>

    <button class="btn btn-primary">Update</button>
    <a href="{{ route('lantai.index') }}" class="btn btn-secondary">Kembali</a>

</form>

@endsection
