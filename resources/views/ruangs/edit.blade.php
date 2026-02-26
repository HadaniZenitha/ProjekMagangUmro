@extends('layouts.dashboard')

@section('title', 'Edit Ruang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('ruangs.update', $ruang->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Nama Ruang</label>
                <input type="text" name="nama_ruang"
                       value="{{ $ruang->nama_ruang }}"
                       class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">Kembali</a>
        </form>

    </div>
</div>
@endsection
