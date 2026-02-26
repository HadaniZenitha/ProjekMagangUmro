@extends('layouts.dashboard')

@section('page-title', 'Tambah Lantai')

@section('content')

<form action="{{ route('lantai.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Gedung</label>
        <select name="gedung_id" class="form-control" required>
            <option value="">-- Pilih Gedung --</option>
            @foreach($gedungs as $g)
                <option value="{{ $g->id }}">
                    {{ $g->kode_gedung }} - {{ $g->nama_gedung }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Kode Lantai</label>
        <input type="text" name="kode_lantai"
               class="form-control"
               placeholder="Contoh: L1.5 / Basement"
               required>
    </div>

    <div class="mb-3">
        <label>Nama Lantai (Opsional)</label>
        <input type="text" name="nama_lantai"
               class="form-control"
               placeholder="Contoh: Lantai Tengah">
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('lantai.index') }}" class="btn btn-secondary">Kembali</a>

</form>

@endsection
