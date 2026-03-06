@extends('layouts.dashboard')

@section('title', 'Tambah Sub Jenis Barang')
<<<<<<< HEAD
@section('page-title', 'Tambah Sub Jenis Barang')

@section('content')

<div class="card shadow-sm">
    <div class="card-body">

        {{-- Tampilkan error validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('subjenis.store') }}" method="POST">
            @csrf

            <!-- Jenis Barang -->
            <div class="mb-3">
                <label class="form-label">Jenis Barang</label>
                <select name="jenis_barang_id"
                        class="form-select"
                        required>
                    <option value="">-- Pilih Jenis Barang --</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Nama Sub Jenis -->
            <div class="mb-3">
                <label class="form-label">Nama Sub Jenis</label>
                <input type="text"
                       name="nama_subjenis"
                       class="form-control"
                       placeholder="Contoh: Laptop Gaming"
                       required>
            </div>

            <!-- Tombol -->
            <div class="d-flex left-content-end mt-3">

                <button type="submit" 
                        class="btn btn-success me-2 shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('subjenis.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

            </div>

        </form>

    </div>
</div>

=======

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Sub Jenis Barang</h5>
    <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">
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

        <form method="POST" action="{{ route('subjenis.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Jenis Barang</label>
                <select name="jenis_barang_id" class="form-select" required>
                    <option value="">-- Pilih Jenis Barang --</option>
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}">{{ $j->nama_jenis }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="form-label">Nama Sub Jenis</label>
                <input type="text" 
                       name="nama_subjenis" 
                       class="form-control" 
                       required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('subjenis.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
@endsection