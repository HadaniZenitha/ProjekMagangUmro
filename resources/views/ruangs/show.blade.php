@extends('layouts.dashboard')

@section('title', 'Detail Ruang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">
        <h5>{{ $ruang->nama_ruang }}</h5>
        <p><b>Kode:</b> {{ $ruang->kode_ruang }}</p>

        <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
</div>
@endsection
