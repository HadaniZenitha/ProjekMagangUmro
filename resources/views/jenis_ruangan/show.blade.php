@extends('layouts.dashboard')

@section('page-title', 'Detail Jenis Ruangan')

@section('title', 'Detail Jenis Ruangan')

@section('content')

<ul class="list-group">
    <li class="list-group-item">
        <b>Kode:</b> {{ $jenis_ruangan->kode_jenis_ruangan }}
    </li>
    <li class="list-group-item">
        <b>Nama:</b> {{ $jenis_ruangan->nama_jenis_ruangan }}
    </li>
    <li class="list-group-item">
        <b>Status:</b> {{ $jenis_ruangan->is_active ? 'Aktif' : 'Nonaktif' }}
    </li>
</ul>

<a href="{{ route('jenis-ruangan.index') }}" class="btn btn-secondary mt-3">
    Kembali
</a>

@endsection