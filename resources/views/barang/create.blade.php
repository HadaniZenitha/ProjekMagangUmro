@extends('layouts.dashboard')

@section('title', 'Tambah Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Barang Inventaris</h5>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
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

        <form method="POST" action="{{ route('barang.store') }}">
            @csrf

            <!-- Nama Barang -->
            <div class="mb-3">
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="form-control" required>
            </div>

            <!-- Divisi -->
            <div class="mb-3">
                <label class="form-label">Divisi</label>
                <select name="divisi_id" id="divisiSelect" class="form-select" required>
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
                <label class="form-label">PIC (Penanggung Jawab)</label>
                <select name="pic_id" id="picSelect" class="form-select" required>
                    <option value="">-- Pilih PIC --</option>
                </select>
            </div>

            <!-- Sub Jenis -->
            <div class="mb-3">
                <label class="form-label">Sub Jenis Barang</label>
                <select name="sub_jenis_barang_id" class="form-select" required>
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
                <label class="form-label">Lokasi Ruang</label>
                <select name="ruang_id" class="form-select" required>
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
                <label class="form-label">Tahun Masuk</label>
                <input type="number" name="tahun_perolehan"
                       class="form-control"
                       value="{{ date('Y') }}" required>
            </div>

            <!-- Kondisi -->
            <div class="mb-4">
                <label class="form-label">Kondisi Barang</label>
                <select name="keterangan" class="form-select">
                    <option value="Baik">Baik</option>
                    <option value="Rusak">Rusak</option>
                    <option value="Perlu Perbaikan">Perlu Perbaikan</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('barang.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let divisiSelect = document.getElementById('divisiSelect');
    let picSelect = document.getElementById('picSelect');

    function loadPicByDivisi(divisiId) {
        picSelect.innerHTML = '<option value="">Loading...</option>';

        if (divisiId) {
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
                })
                .catch(function() {
                    picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';
                });
        } else {
            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';
        }
    }

    divisiSelect.addEventListener('change', function() {
        loadPicByDivisi(this.value);
    });
});
</script>

@endsection