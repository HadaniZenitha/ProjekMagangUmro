@extends('layouts.dashboard')

@section('page-title', 'Detail Lantai')

@section('content')

<ul class="list-group">
    <li class="list-group-item">
        <b>Gedung:</b> {{ $lantai->gedung->nama_gedung }}
    </li>
    <li class="list-group-item">
        <b>Kode Lantai:</b> {{ $lantai->kode_lantai }}
    </li>
    <li class="list-group-item">
        <b>Nama Lantai:</b> {{ $lantai->nama_lantai ?? '-' }}
    </li>
    <li class="list-group-item">
        <b>Status:</b> {{ $lantai->is_active ? 'Aktif' : 'Nonaktif' }}
    </li>
</ul>

<a href="{{ route('lantai.index') }}" class="btn btn-secondary mt-3">
    Kembali
</a>

@endsection
