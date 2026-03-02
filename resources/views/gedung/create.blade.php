@extends('layouts.dashboard')

@section('title', 'Tambah Gedung')
@section('page-title', 'Tambah Gedung')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('gedung.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Kode Gedung</label>
                <input type="text" name="kode_gedung"
                       class="form-control"
                       placeholder="Contoh: SB"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Gedung</label>
                <input type="text" name="nama_gedung"
                       class="form-control"
                       placeholder="Contoh: Smart Building"
                       required>
            </div>

            <div class="d-flex left-content-end mt-3">
                <a href="{{ route('gedung.index') }}" 
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