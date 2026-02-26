@extends('layouts.dashboard')

@section('title', 'Detail Sub Jenis Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <h5>Kode: {{ $subjenis->kode_subjenis }}</h5>
        <p><b>Nama:</b> {{ $subjenis->nama_subjenis }}</p>
        <p><b>Jenis:</b> {{ $subjenis->jenis->nama_jenis }}</p>
        <p><b>Deskripsi:</b> {{ $subjenis->deskripsi }}</p>

        <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">
            Kembali
        </a>

    </div>
</div>
@endsection
