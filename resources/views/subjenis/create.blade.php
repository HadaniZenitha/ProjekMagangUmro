@extends('layouts.dashboard')

@section('title', 'Master Data')

@section('content')
<div class="container">

    <h2>Tambah Sub Jenis Barang</h2>

    <form method="POST" action="{{ route('subjenis.store') }}">
        @csrf

        <div class="mb-3">
            <label>Jenis Barang</label>
            <select name="jenis_barang_id" class="form-control">
                @foreach($jenisList as $j)
                    <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                @endforeach
            </select>
        </div>

        {{-- <div class="mb-3">
            <label>Kode Sub Jenis</label>
            <input type="text" name="kode_subjenis" class="form-control">
        </div> --}}

        <div class="mb-3">
            <label>Nama Sub Jenis</label>
            <input type="text" name="nama_subjenis" class="form-control">
        </div>

        <button class="btn btn-success">Simpan</button>
        <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>
@endsection
