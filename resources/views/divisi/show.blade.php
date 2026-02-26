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
            {{ $divisi->is_active ? 'Aktif' : 'Nonaktif' }}
        </li>
    </ul>

    <a href="{{ route('divisi.index') }}" class="btn btn-secondary mt-3">
        Kembali
    </a>
</div>
@endsection
