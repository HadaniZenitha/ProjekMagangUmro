@extends('layouts.dashboard')

@section('title', 'Tambah Sub Jenis Barang')
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

@endsection