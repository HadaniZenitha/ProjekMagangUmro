@extends('layouts.dashboard')

@section('title', 'Detail Gedung')
@section('page-title', 'Detail Gedung')

@section('content')

<ul class="list-group">
    <li class="list-group-item">
        <b>Kode Gedung:</b> {{ $gedung->kode_gedung }}
    </li>

    <li class="list-group-item">
        <b>Nama Gedung:</b> {{ $gedung->nama_gedung }}
    </li>

    <li class="list-group-item">
        <b>Status:</b>
        {{ $gedung->is_active ? 'Aktif' : 'Nonaktif' }}
    </li>
</ul>

<a href="{{ route('gedung.index') }}" class="btn btn-secondary mt-3">
    Kembali
</a>

@endsection
