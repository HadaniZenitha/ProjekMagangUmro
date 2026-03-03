@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2>Detail Divisi</h2>

    <ul class="list-group">
        <li class="list-group-item">
            <b>Kode:</b> {{ $divisi->kode_divisi }}
        </li>
        <li class="list-group-item">
            <b>Nama:</b> {{ $divisi->nama_divisi }}
        </li>
        <li class="list-group-item">
            <b>Status:</b>

            @if($divisi->is_active)
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
</div>
@endsection
