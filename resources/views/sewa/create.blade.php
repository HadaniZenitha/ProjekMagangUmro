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

        <form method="POST" action="{{ route('barang-sewa.store') }}" id="barangSewaForm" data-old-pic-id="{{ old('pic_id') }}">
            @csrf

            {{-- Kode Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Kode Barang</label>
                <input type="text" name="kode_barang" class="form-control" required>
            </div>

            {{-- Nama Barang --}}
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" value="{{ old('nama_barang') }}" required>
            </div>

            {{-- Fungsi --}}
            <div class="mb-3">
                <label class="form-label">Fungsi</label>
                <select name="divisi_id" id="fungsiSelect" class="form-select" required>
                    <option value="">-- Pilih Fungsi --</option>
                    @foreach($divisis as $divisi)
                        <option value="{{ $divisi->id }}" {{ old('divisi_id') == $divisi->id ? 'selected' : '' }}>
                            {{ $divisi->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- PIC --}}
            <div class="mb-3">
                <label class="form-label">PIC</label>
                <select name="pic_id" id="picSelect" class="form-select" required disabled>
                    <option value="">-- Pilih Fungsi terlebih dahulu --</option>
                </select>
            </div>

            {{-- Lokasi --}}
            <div class="mb-3">
                <label class="form-label">Lokasi</label>
                <select name="ruang_id" class="form-select" required>
                    <option value="">-- Pilih Ruang --</option>
                    @foreach($ruangs as $r)
                        <option value="{{ $r->id }}" {{ old('ruang_id') == $r->id ? 'selected' : '' }}>
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
                    <option value="Baik" {{ old('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Perlu Perbaikan" {{ old('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
                    <option value="Rusak" {{ old('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
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

<script>
    const fungsiSelect = document.getElementById('fungsiSelect');
    const picSelect = document.getElementById('picSelect');
    const oldPicId = document.getElementById('barangSewaForm').dataset.oldPicId;

    async function loadPics(divisiId, selectedPicId = null) {
        picSelect.innerHTML = '<option value="">Memuat PIC...</option>';
        picSelect.disabled = true;

        if (!divisiId) {
            picSelect.innerHTML = '<option value="">-- Pilih Fungsi terlebih dahulu --</option>';
            return;
        }

        try {
            const response = await fetch(`/get-pic-by-divisi/${divisiId}`);
            const pics = await response.json();

            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

            pics.forEach((pic) => {
                const option = document.createElement('option');
                option.value = pic.id;
                option.textContent = `${pic.nama_pic} (${pic.jabatan ?? '-'})`;
                if (selectedPicId && String(selectedPicId) === String(pic.id)) {
                    option.selected = true;
                }
                picSelect.appendChild(option);
            });

            picSelect.disabled = pics.length === 0;
            if (pics.length === 0) {
                picSelect.innerHTML = '<option value="">PIC untuk fungsi ini belum tersedia</option>';
            }
        } catch (error) {
            picSelect.innerHTML = '<option value="">Gagal memuat PIC</option>';
        }
    }

    fungsiSelect.addEventListener('change', function () {
        loadPics(this.value);
    });

    if (fungsiSelect.value) {
        loadPics(fungsiSelect.value, oldPicId);
    }
</script>

@endsection