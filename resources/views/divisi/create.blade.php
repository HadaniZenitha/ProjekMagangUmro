@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Tambah Divisi</h2>

    <form action="{{ route('divisi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Kode Divisi</label>
            <input type="text" name="kode_divisi" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Nama Divisi</label>
            <input type="text" name="nama_divisi" class="form-control" required>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('divisi.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
