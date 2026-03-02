@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h2 class="mb-4">Tambah Divisi</h2>

    <div class="card shadow-sm p-4">
        <form action="{{ route('divisi.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Divisi</label>
                <input type="text" name="kode_divisi" 
                       class="form-control" 
                       placeholder="Masukkan kode divisi" 
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Nama Divisi</label>
                <input type="text" name="nama_divisi" 
                       class="form-control" 
                       placeholder="Masukkan nama divisi" 
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-2"></i> Simpan
                </button>

                <a href="{{ route('divisi.index') }}" 
                   class="btn btn-warning shadow-sm">
                    <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection