@extends('layouts.dashboard')

@section('title', 'Edit Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Barang Inventaris</h5>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i> Kembali
    </a>
</div>

{{-- Tampilkan Error Validasi --}}
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

        <form method="POST" action="{{ route('barang.update', $barang->id) }}">
            @csrf
            @method('PUT')

            {{-- Kode Barang (Readonly) --}}
            <div class="mb-3">
                <label class="form-label">Kode Barang</label>
                <input type="text"
                       class="form-control"
                       value="{{ $barang->kode_barang }}"
                       readonly>
            </div>

            {{-- Sub Jenis (Readonly) --}}
            <div class="mb-3">
                <label class="form-label">Sub Jenis</label>
                <input type="text"
                       class="form-control"
                       value="{{ $barang->subjenis->nama_subjenis }}"
                       readonly>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       required>
            </div>

            {{-- PIC --}}
            <div class="mb-3">
                <label class="form-label">PIC (Penanggung Jawab)</label>
                <select name="pic_id" class="form-select" required>
                    @foreach($pics as $p)
                        <option value="{{ $p->id }}"
                            {{ $barang->pic_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_pic }} ({{ $p->divisi->nama_divisi }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Merk --}}
            <div class="mb-3">
                <label class="form-label">Merk</label>
                <input type="text"
                       name="merk"
                       class="form-control"
                       value="{{ old('merk', $barang->merk) }}">
            </div>

            {{-- Serial Number --}}
            <div class="mb-3">
                <label class="form-label">Serial Number</label>
                <input type="text"
                       name="serial_number"
                       class="form-control"
                       value="{{ old('serial_number', $barang->serial_number) }}">
            </div>

            {{-- Tahun Perolehan --}}
            <div class="mb-3">
                <label class="form-label">Tahun Perolehan</label>
                <input type="number"
                       name="tahun_perolehan"
                       class="form-control"
                       value="{{ old('tahun_perolehan', $barang->tahun_perolehan) }}">
            </div>

            {{-- Lokasi Ruang --}}
            <div class="mb-3">
                <label class="form-label">Lokasi Ruang</label>
                <select name="ruang_id" class="form-select">
                    @foreach($ruangs as $r)
                        <option value="{{ $r->id }}"
                            {{ $barang->ruang_id == $r->id ? 'selected' : '' }}>
                            {{ $r->nama_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Keterangan --}}
            <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3">{{ old('keterangan', $barang->keterangan) }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-select" required>
                    <option value="1" {{ $barang->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$barang->is_active ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('barang.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection