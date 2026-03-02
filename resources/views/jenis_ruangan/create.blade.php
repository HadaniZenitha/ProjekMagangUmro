@extends('layouts.dashboard')

@section('page-title', 'Tambah Jenis Ruangan')
@section('title', 'Tambah Jenis Ruangan')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('jenis-ruangan.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Jenis Ruangan</label>
                <input type="text"
                       name="kode_jenis_ruangan"
                       class="form-control"
                       placeholder="Contoh: TL"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Jenis Ruangan</label>
                <input type="text"
                       name="nama_jenis_ruangan"
                       class="form-control"
                       placeholder="Contoh: Toilet"
                       required>
            </div>

            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('jenis-ruangan.index') }}" 
                   class="btn btn-warning me-2 shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>
            </div>

        </form>

    </div>
</div>

@endsection