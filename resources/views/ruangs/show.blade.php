@extends('layouts.dashboard')

@section('content')
<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Detail Ruang</h2>

        <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Nama Ruang:</b> {{ $ruang->nama_ruang }}
        </li>

        <li class="list-group-item">
            <b>Kode Ruang:</b> {{ $ruang->kode_ruang }}
        </li>
    </ul>

</div>
@endsection