@extends('layouts.dashboard')

@section('page-title', 'Tambah Jenis Ruangan')

@section('title', 'Tambah Jenis Ruangan')

@section('content')

<form action="{{ route('jenis-ruangan.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label>Kode Jenis Ruangan</label>
        <input type="text" name="kode_jenis_ruangan"
               class="form-control"
               placeholder="Contoh: TL"
               required>
    </div>

    <div class="mb-3">
        <label>Nama Jenis Ruangan</label>
        <input type="text" name="nama_jenis_ruangan"
               class="form-control"
               placeholder="Contoh: Toilet"
               required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('jenis-ruangan.index') }}" class="btn btn-secondary">
        Kembali
    </a>

</form>

@endsection