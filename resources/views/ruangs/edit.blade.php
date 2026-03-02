@extends('layouts.dashboard')

@section('page-title', 'Edit Ruang')
@section('title', 'Edit Ruang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('ruangs.update', $ruang->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nama Ruang</label>
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-building"></i>
                    </span>
                    <input type="text"
                           name="nama_ruang"
                           value="{{ $ruang->nama_ruang }}"
                           class="form-control"
                           required>
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-check me-2"></i> Update
                </button>

                <a href="{{ route('divisi.index') }}" 
                   class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left me-2"></i> Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection