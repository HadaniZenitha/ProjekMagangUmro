@extends('layouts.dashboard')

@section('title', 'Tambah Barang Inventaris')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Barang Inventaris</h5>
    <a href="{{ route('barang.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i> Kembali
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
        <form method="POST" action="{{ route('barang.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang <span class="text-danger">*</span></label>
                <input type="text" name="nama_barang" class="form-control" placeholder="Masukkan nama barang" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Fungsi <span class="text-danger">*</span></label>
                    <select name="divisi_id" id="divisiSelect" class="form-select" required>
                        <option value="">-- Pilih Fungsi --</option>
                        @foreach($divisis as $d)
                            <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">PIC (Penanggung Jawab) <span class="text-danger">*</span></label>
                    <select name="pic_id" id="picSelect" class="form-select" required>
                        <option value="">-- Pilih PIC --</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Sub Jenis Barang <span class="text-danger">*</span></label>
                    <input list="subjenisOptions" id="subjenis-input" class="form-control" placeholder="Ketik untuk mencari sub jenis..." required>
                    
                    <datalist id="subjenisOptions">
                        @foreach($subjenisList as $s)
                            <option data-id="{{ $s->id }}" value="{{ $s->kode_subjenis }} - {{ $s->nama_subjenis }}">
                        @endforeach
                    </datalist>
                    
                    <input type="hidden" name="sub_jenis_barang_id" id="subjenis-hidden">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lokasi Ruang <span class="text-danger">*</span></label>
                    <select name="ruang_id" class="form-select" required>
                        <option value="">-- Pilih Ruang --</option>
                        @foreach($ruangs as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tahun Perolehan <span class="text-danger">*</span></label>
                    <input type="number" name="tahun_perolehan" class="form-control" value="{{ date('Y') }}" required>
                </div>

                <div class="col-md-6 mb-4">
                    <label class="form-label fw-semibold">Kondisi Barang <span class="text-danger">*</span></label>
                    <select name="kondisi" class="form-select" required>
                        <option value="baik">Baik</option>
                        <option value="perlu perbaikan">Perlu Perbaikan</option>
                        <option value="rusak">Rusak</option>
                    </select>
                </div>
            </div>

            <!-- Upload Foto -->
            <div class="mb-4">
                <label class="form-label fw-semibold">Foto Barang (Opsional)</label>
                <input type="file" name="foto" class="form-control" accept="image/*">
                <small class="text-muted">Format: jpg, jpeg, png. Maksimal 2MB</small>
            </div>

            <div class="d-flex gap-2 border-top pt-3">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>
                <a href="{{ route('barang.index') }}" class="btn btn-light px-4">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const divisiSelect = document.getElementById('divisiSelect');
    const picSelect = document.getElementById('picSelect');
    const subjenisInput = document.getElementById('subjenis-input');
    const subjenisHidden = document.getElementById('subjenis-hidden');
    const subjenisOptions = document.getElementById('subjenisOptions');

    // 1. Logika Load PIC Berdasarkan Divisi
    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;
        
        // Reset dropdown PIC
        picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

        if (!divisiId) return;

        picSelect.innerHTML = '<option value="">Memuat...</option>';

        // Fetch data dari server
        fetch('/get-pic-by-divisi/' + divisiId, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => {
            if (!response.ok) throw new Error('Error pada server');
            return response.json();
        })
        .then(data => {
            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';
            if (data.length === 0) {
                picSelect.innerHTML = '<option value="">Tidak ada PIC tersedia</option>';
            } else {
                data.forEach(pic => {
                    const option = document.createElement('option');
                    option.value = pic.id;
                    option.textContent = pic.nama_pic;
                    picSelect.appendChild(option);
                });
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            picSelect.innerHTML = '<option value="">Gagal memuat data</option>';
        });
    });

    // 2. Logika Pencarian Sub Jenis (Mapping Datalist ke Hidden Input)
    subjenisInput.addEventListener('input', function() {
        const val = this.value;
        const options = subjenisOptions.querySelectorAll('option');
        
        // Kosongkan hidden input dulu
        subjenisHidden.value = "";

        options.forEach(option => {
            if (option.value === val) {
                subjenisHidden.value = option.getAttribute('data-id');
            }
        });
    });

    // Validasi tambahan sebelum submit: pastikan ID subjenis terisi
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!subjenisHidden.value) {
            e.preventDefault();
            alert('Silakan pilih Sub Jenis Barang dari daftar yang tersedia.');
            subjenisInput.focus();
        }
    });
});
</script>
@endsection