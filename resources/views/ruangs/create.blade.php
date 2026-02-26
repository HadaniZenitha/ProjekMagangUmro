@extends('layouts.dashboard')

@section('page-title', 'Tambah Ruang')

@section('title', 'Data Ruang')

@section('content')

<form action="{{ route('ruangs.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Lantai</label>
        <select name="lantai_id" class="form-control" required>
            <option value="">-- Pilih Lantai --</option>
            @foreach($lantais as $l)
                <option value="{{ $l->id }}">
                    {{ $l->gedung->kode_gedung }} -
                    {{ $l->kode_lantai }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Jenis Ruangan</label>
        <select name="jenis_ruangan_id" class="form-control" required>
            <option value="">-- Pilih Jenis --</option>
            @foreach($jenisRuangans as $j)
                <option value="{{ $j->id }}">
                    {{ $j->kode_jenis_ruangan }} - {{ $j->nama_jenis_ruangan }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Nama Ruang</label>
        <input type="text" name="nama_ruang" class="form-control" required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">Kembali</a>

</form>

@endsection