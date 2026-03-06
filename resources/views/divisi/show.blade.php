@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Detail Divisi</h2>

    <ul class="list-group shadow-sm">
        <li class="list-group-item">
            <b>Kode:</b> {{ $divisi->kode_divisi }}
        </li>

        <li class="list-group-item">
            <b>Nama:</b> {{ $divisi->nama_divisi }}
        </li>

        <li class="list-group-item d-flex left-content-between align-items-center">
            <b>Status:</b>

            @if($divisi->is_active)
<<<<<<< HEAD
                <span class="badge bg-success px-3 py-2">
                    Aktif
                </span>
            @else
                <span class="badge bg-danger px-3 py-2">
                    Nonaktif
                </span>
            @endif

        </li>
    </ul>

    <div class="mt-3">
        <a href="{{ route('divisi.index') }}" 
           class="btn btn-warning mt-4 shadow-sm text-dark">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
=======
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

    <a href="{{ route('divisi.index') }}" class="btn btn-secondary mt-3">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
</div>
@endsection