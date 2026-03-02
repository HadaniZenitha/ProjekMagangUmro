@extends('layouts.dashboard')

@section('title', 'Edit Barang Inventaris')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="mb-4">
            <i class="fas fa-edit text-warning"></i>
            Edit Barang Inventaris
        </h4>

        {{-- Error Validasi --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('barang.update', $barang->id) }}">
            @csrf
            @method('PUT')

            {{-- Kode Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Barang</label>
                <input type="text"
                       class="form-control bg-light"
                       value="{{ $barang->kode_barang }}"
                       readonly>
            </div>

            {{-- Sub Jenis --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Sub Jenis</label>
                <input type="text"
                       class="form-control bg-light"
                       value="{{ $barang->subjenis->nama_subjenis }}"
                       readonly>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text"
                       name="nama_barang"
                       class="form-control"
                       value="{{ old('nama_barang', $barang->nama_barang) }}"
                       required>
            </div>

            {{-- PIC --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    PIC (Penanggung Jawab)
                </label>
                <select name="pic_id"
                        class="form-select"
                        required>
                    <option value="">-- Pilih PIC --</option>
                    @foreach($pics as $p)
                        <option value="{{ $p->id }}"
                            {{ $barang->pic_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_pic }} 
                            ({{ $p->divisi->nama_divisi }})
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Merk --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Merk</label>
                <input type="text"
                       name="merk"
                       class="form-control"
                       value="{{ old('merk', $barang->merk) }}">
            </div>

            {{-- Serial Number --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Serial Number</label>
                <input type="text"
                       name="serial_number"
                       class="form-control"
                       value="{{ old('serial_number', $barang->serial_number) }}">
            </div>

            {{-- Tahun Perolehan --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Tahun Perolehan</label>
                <input type="number"
                       name="tahun_perolehan"
                       class="form-control"
                       value="{{ old('tahun_perolehan', $barang->tahun_perolehan) }}">
            </div>

            {{-- Lokasi Ruang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi Ruang</label>
                <select name="ruang_id" class="form-select">
                    <option value="">-- Pilih Ruang --</option>
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
                <label class="form-label fw-semibold">Keterangan</label>
                <textarea name="keterangan"
                          class="form-control"
                          rows="3">{{ old('keterangan', $barang->keterangan) }}</textarea>
            </div>

            {{-- Status --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Status</label>
                <select name="is_active"
                        class="form-select"
                        required>
                    <option value="1" {{ $barang->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$barang->is_active ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>

            {{-- Tombol --}}
            <div class="d-flex gap-2">
                <button type="submit"
                        class="btn btn-warning px-4 text-white">
                    <i class="fas fa-save me-1"></i>
                    Update
                </button>

                <a href="{{ route('barang.index') }}"
                   class="btn btn-outline-secondary px-4">
                    <i class="fas fa-arrow-left me-1"></i>
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>
@endsection