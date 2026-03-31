@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Ruang</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Nama Ruang:</b> {{ $ruang->nama_ruang }}
        </li>
        <li class="list-group-item">
            <b>Kode Ruang:</b> {{ $ruang->kode_ruang }}
        </li>
    </ul>

    <a href="{{ route('ruangs.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
</div>
@endsection