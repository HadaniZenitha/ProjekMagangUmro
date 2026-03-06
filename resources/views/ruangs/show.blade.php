@extends('layouts.dashboard')

<<<<<<< HEAD
@section('title', 'Detail Ruang')
@section('page-title', 'Detail Ruang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <h5 class="mb-3">{{ $ruang->nama_ruang }}</h5>

        <p>
            <b>Kode Ruang :</b> {{ $ruang->kode_ruang }}
        </p>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('ruangs.index') }}" 
               class="btn btn-warning shadow-sm text-dark">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </div>
</div>

=======
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
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection