@extends('layouts.dashboard')

@section('title', 'Edit Barang Inventaris')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

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

            <div class="mb-3">
                <label>Sub Jenis</label>
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
                <select name="pic_id" class="form-control" required>
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
                <select name="ruang_id" class="form-control">
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

            {{-- Status Aktif --}}
            <div class="mb-3">
                <label class="form-label">Status</label>
                <select name="is_active" id="statusSelect" class="form-control" required>
                    <option value="1" {{ $barang->is_active ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="0" {{ !$barang->is_active ? 'selected' : '' }}>
                        Tidak Aktif
                    </option>
                </select>
            </div>
            {{-- Catatan Keterangan Nonaktif --}}
            <div class="mb-3" id="catatanWrapper"
                 style="{{ $barang->is_active ? 'display:none;' : '' }}">
                <label>Catatan Nonaktif</label>
                <textarea name="catatan_nonaktif"
                          class="form-control"
                          rows="3">{{ old('catatan_nonaktif', $barang->catatan_nonaktif) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">
                Update
            </button>

            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>
<script>
const statusSelect = document.getElementById('statusSelect');
const catatanWrapper = document.getElementById('catatanWrapper');

statusSelect.addEventListener('change', function() {

    if(this.value == "0") {
        catatanWrapper.style.display = 'block';
    } else {
        catatanWrapper.style.display = 'none';
    }

});
</script>
@endsection