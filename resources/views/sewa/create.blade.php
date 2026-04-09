@extends('layouts.dashboard')

@section('title', 'Tambah Barang Sewa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Barang Sewa</h5>
    <a href="{{ route('barang-sewa.index') }}" class="btn btn-secondary">
        Kembali
    </a>
</div>

{{-- ERROR VALIDASI --}}
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

        <form method="POST" action="{{ route('barang-sewa.store') }}">
            @csrf

            {{-- Kode Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" required>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" required>
            </div>

            {{-- Fungsi --}}
            <div class="mb-3">
                <label class="form-label">Fungsi</label>
                <input type="text" name="fungsi" class="form-control" placeholder="Contoh: IT, Keuangan">
            </div>

            {{-- PIC --}}
            <div class="mb-3">
                <label class="form-label">PIC</label>
                <select name="pic_id" class="form-select" required>
                    <option value="">-- Pilih PIC --</option>
                    @foreach($pics as $p)
                        <option value="{{ $p->id }}">
                            {{ $p->nama_pic }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Lokasi --}}
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <select name="ruang_id" class="form-select" required>
                    <option value="">-- Pilih Ruang --</option>
                    @foreach($ruangs as $r)
                        <option value="{{ $r->id }}">
                            {{ $r->nama_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Tahun --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tahun</label>
                <input type="number"
                       name="tahun"
                       class="form-control"
                       value="{{ date('Y') }}"
                       required>
            </div>

            {{-- Kondisi --}}
            <div class="mb-3">
                <label class="form-label">Kondisi</label>
                <select name="kondisi" class="form-select" required>
                    <option value="Baik">Baik</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                    <option value="Rusak">Rusak</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i>
                    Simpan
                </button>

                <a href="{{ route('barang-sewa.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection