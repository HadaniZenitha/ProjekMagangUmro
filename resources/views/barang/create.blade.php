@extends('layouts.dashboard')

@section('title', 'Tambah Barang Inventaris')

@section('content')
<div class="card shadow-sm border-0">
    <div class="card-body">

        <h4 class="mb-4">
            <i class="fas fa-box-open text-primary"></i>
            Tambah Barang Inventaris
        </h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('barang.store') }}">
            @csrf

            <!-- Nama Barang -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="form-control" required>
            </div>

            <!-- Divisi -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Divisi</label>
                <select name="divisi_id"
                        id="divisiSelect"
                        class="form-select"
                        required>
                    <option value="">-- Pilih Divisi --</option>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- PIC -->
            <div class="mb-3">
                <label class="form-label fw-semibold">
                    PIC (Penanggung Jawab)
                </label>
                <select name="pic_id"
                        id="picSelect"
                        class="form-select"
                        required>
                    <option value="">-- Pilih PIC --</option>
                </select>
            </div>

            <!-- Sub Jenis -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Sub Jenis Barang</label>
                <select name="sub_jenis_barang_id"
                        class="form-select"
                        required>
                    <option value="">-- Pilih Sub Jenis --</option>
                    @foreach($subjenisList as $s)
                        <option value="{{ $s->id }}">
                            {{ $s->kode_subjenis }} - {{ $s->nama_subjenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Ruang -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Lokasi Ruang</label>
                <select name="ruang_id"
                        class="form-select"
                        required>
                    <option value="">-- Pilih Ruang --</option>
                    @foreach($ruangs as $r)
                        <option value="{{ $r->id }}">
                            {{ $r->nama_ruang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tahun Masuk -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Tahun Masuk</label>
                <input type="number"
                       name="tahun_perolehan"
                       class="form-control"
                       value="{{ date('Y') }}"
                       required>
            </div>

            <!-- Kondisi -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Kondisi Barang</label>
                <select name="keterangan" class="form-select">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                </select>
            </div>

            <!-- Tombol -->
            <div class="d-flex gap-2">
                <button class="btn btn-success px-4">
                    <i class="fas fa-save me-1"></i>
                    Simpan
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

{{-- Script Ajax PIC berdasarkan Divisi --}}
<script>
document.getElementById('divisiSelect').addEventListener('change', function() {

    let divisiId = this.value;
    let picSelect = document.getElementById('picSelect');

    picSelect.innerHTML = '<option value="">Loading...</option>';

    if(divisiId) {
        fetch('/get-pic-by-divisi/' + divisiId)
        .then(response => response.json())
        .then(data => {

            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

            data.forEach(function(pic) {
                picSelect.innerHTML += 
                    `<option value="${pic.id}">
                        ${pic.nama_pic}
                    </option>`;
            });

        });
    } else {
        picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';
    }
});
</script>

@endsection