@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Tambah Kelompok Barang</h2>

    <form method="POST" action="{{ route('kelompok.store') }}">
        @csrf

        {{-- <div class="mb-3">
            <label>Kode Kelompok</label>
            <input type="text" name="kode_kelompok" class="form-control">
        </div> --}}

        <div class="mb-3">
            <label>Nama Kelompok</label>
            <input type="text" name="nama_kelompok" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('kelompok.index') }}" class="btn btn-secondary">Kembali</a>
    </form>

</div>
@endsection
