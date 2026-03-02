@extends('layouts.dashboard')

@section('title', 'Edit Ruang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Ruang</h5>
    <a href="{{ route('ruangs.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('ruangs.update', $ruang->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="form-label">Nama Ruang</label>
                <input type="text"
                       name="nama_ruang"
                       value="{{ $ruang->nama_ruang }}"
                       class="form-control"
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('ruangs.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection