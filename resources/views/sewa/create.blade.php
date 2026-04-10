@extends('layouts.dashboard')

@section('title', 'Tambah Barang Sewa')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah Barang Sewa</h5>
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

        <form method="POST" action="{{ route('barang-sewa.store') }}" id="barangSewaForm" data-old-pic-id="{{ old('pic_id') }}">
            @csrf

            {{-- KODE BARANG (BARU) --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Barang <span class="text-danger">*</span></label>
                <input type="text" name="kode_barang" class="form-control" 
                       placeholder="Contoh: SEWA-001" required>
            </div>

            {{-- NAMA --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
            </div>

            {{-- ROW 1 --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Fungsi <span class="text-danger">*</span></label>
                    <select name="fungsi_id" id="divisiSelect" class="form-select" required>
                        <option value="">-- Pilih Fungsi --</option>
                        @foreach($divisis as $d)
                            <option value="{{ $d->id }}">{{ $d->nama_divisi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">PIC <span class="text-danger">*</span></label>
                    <select name="pic_id" id="picSelect" class="form-select" required>
                        <option value="">-- Pilih PIC --</option>
                    </select>
                </div>
            </div>

            {{-- ROW 2 --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lokasi</label>
                    <select name="ruang_id" class="form-select" required>
                        <option value="">-- Pilih Ruang --</option>
                        @foreach($ruangs as $r)
                            <option value="{{ $r->id }}">{{ $r->nama_ruang }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Tahun</label>
                    <input type="number" name="tahun" class="form-control" 
                           value="{{ date('Y') }}" required>
                </div>
            </div>

            {{-- KONDISI --}}
            <div class="mb-4">
                <label class="form-label fw-semibold">Kondisi</label>
                <select name="kondisi" class="form-select" required>
                    <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Perlu Perbaikan" {{ old('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                </select>
            </div>

            {{-- BUTTON --}}
            <div class="d-flex gap-2 border-top pt-3">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fa-solid fa-save me-1"></i> Simpan
                </button>

                <a href="{{ route('barang-sewa.index') }}" class="btn btn-danger px-4">
                    <i class="fa-solid fa-xmark me-1"></i> Batal
                </a>
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

    divisiSelect.addEventListener('change', function() {
        const divisiId = this.value;

        picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

        if (!divisiId) return;

        picSelect.innerHTML = '<option value="">Memuat...</option>';

        fetch('/get-pic-by-divisi/' + divisiId, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(res => res.json())
        .then(data => {
            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

            data.forEach(pic => {
                const option = document.createElement('option');
                option.value = pic.id;
                option.textContent = pic.nama_pic;
                picSelect.appendChild(option);
            });
        })
        .catch(() => {
            picSelect.innerHTML = '<option value="">Gagal memuat PIC</option>';
        });
    });

});
</script>
@endsection