@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Tambah Jenis Barang</h2>

    <form method="POST" action="{{ route('jenis.store') }}">
        @csrf

        <div class="mb-3">
            <label>Kelompok Barang</label>
            <select name="kelompok_barang_id" class="form-control">
                @foreach($kelompoks as $k)
                    <option value="{{ $k->id }}">{{ $k->nama_kelompok }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label>Kode Jenis</label>
            <input type="text" name="kode_jenis" class="form-control">
        </div> --}}

        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('jenis.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>
@endsection
