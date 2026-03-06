@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Gedung</h2>

<<<<<<< HEAD
<div class="card shadow-sm">
    <div class="card-body">

        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <b>Kode Gedung:</b> {{ $gedung->kode_gedung }}
            </li>

            <li class="list-group-item">
                <b>Nama Gedung:</b> {{ $gedung->nama_gedung }}
            </li>

            <li class="list-group-item">
                <b>Status:</b>
                @if($gedung->is_active)
                    <span class="badge bg-success">Aktif</span>
                @else
                    <span class="badge bg-danger">Nonaktif</span>
                @endif
            </li>
        </ul>

        <div class="mt-3">
            <a href="{{ route('gedung.index') }}" 
               class="btn btn-warning shadow-sm text-white">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

    </div>
</div>

=======
    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode:</b> {{ $gedung->kode_gedung }}
        </li>
        <li class="list-group-item">
            <b>Nama:</b> {{ $gedung->nama_gedung }}
        </li>
        <li class="list-group-item">
            <b>Status:</b>

            @if($gedung->is_active)
                <span class="badge bg-success ms-2">
                    <i class="fa-solid fa-circle-check me-1"></i> Aktif
                </span>
            @else
                <span class="badge bg-danger ms-2">
                    <i class="fa-solid fa-circle-xmark me-1"></i> Nonaktif
                </span>
            @endif
        </li>    
    </ul>

    <a href="{{ route('gedung.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
</div>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection