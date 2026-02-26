@extends('layouts.dashboard')

@section('title', 'Tambah Gedung')
@section('page-title', 'Tambah Gedung')

@section('content')

<form action="{{ route('gedung.store') }}" method="POST">
    @csrf

    <div class="mb-3">
        <label class="form-label">Kode Gedung</label>
        <input type="text" name="kode_gedung"
               class="form-control"
               placeholder="Contoh: SB"
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama Gedung</label>
        <input type="text" name="nama_gedung"
               class="form-control"
               placeholder="Contoh: Smart Building"
               required>
    </div>

    <button class="btn btn-success">Simpan</button>
    <a href="{{ route('gedung.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</form>

@endsection
