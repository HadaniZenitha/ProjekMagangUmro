@extends('layouts.dashboard')

@section('title', 'Edit Item Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0 text-dark">
        Edit Item Inventaris
    </h5>
</div>

{{-- Error Validasi --}}
@if ($errors->any())
<div class="alert alert-danger shadow-sm border-start border-5">
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li><small>{{ $error }}</small></li>
        @endforeach
    </ul>
</div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('barang.update', $barang->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-8">

                    {{-- INFO --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kode Item</label>
                            <input type="text" class="form-control bg-light border-0" value="{{ $barang->kode_barang }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Sub Jenis</label>
                            <input type="text" class="form-control bg-light border-0" value="{{ $barang->subjenis->nama_subjenis }}" readonly>
                        </div>
                    </div>

                    {{-- NAMA --}}
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang"
                               class="form-control @error('nama_barang') is-invalid @enderror"
                               value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    </div>

                    {{-- DIVISI & PIC --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Fungsi</label>
                            <select name="divisi_id" id="divisiSelect" class="form-select" required>
                                <option value="">-- Pilih Fungsi --</option>
                                @foreach($divisis as $d)
                                    <option value="{{ $d->id }}" {{ $barang->divisi_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama_divisi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">PIC</label>
                            <select name="pic_id" id="picSelect" class="form-select" required>
                                <option value="">-- Pilih PIC --</option>
                            </select>
                        </div>
                    </div>

                    {{-- RUANG & TAHUN --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Lokasi Ruang</label>
                            <select name="ruang_id" class="form-select">
                                @foreach($ruangs as $r)
                                <option value="{{ $r->id }}" {{ $barang->ruang_id == $r->id ? 'selected' : '' }}>
                                    {{ $r->nama_ruang }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Tahun Perolehan</label>
                            <input type="number" name="tahun_perolehan"
                                   class="form-control"
                                   value="{{ old('tahun_perolehan', $barang->tahun_perolehan) }}">
                        </div>
                    </div>

                    {{-- KONDISI & STATUS --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kondisi Item</label>
                            <select name="kondisi" class="form-select text-capitalize">
                                @php $kondisis = ['baik', 'perlu perbaikan', 'rusak']; @endphp
                                @foreach($kondisis as $k)
                                <option value="{{ $k }}" {{ strtolower($barang->kondisi) == $k ? 'selected' : '' }}>
                                    {{ ucfirst($k) }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="is_active" id="statusSelect" class="form-select" required>
                                <option value="1" {{ $barang->is_active ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ !$barang->is_active ? 'selected' : '' }}>Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    {{-- CATATAN --}}
                    <div class="mb-4" id="catatanWrapper" style="{{ $barang->is_active ? 'display:none;' : '' }}">
                        <label class="form-label fw-semibold text-danger">Catatan Nonaktif</label>
                        <textarea name="catatan_nonaktif"
                                  class="form-control border-danger"
                                  rows="3">{{ old('catatan_nonaktif', $barang->catatan_nonaktif) }}</textarea>
                    </div>

                </div>

                {{-- FOTO --}}
                <div class="col-md-4">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center">

                            <label class="form-label fw-semibold d-block text-start mb-3">Foto Barang</label>

                            <div class="mb-3">
                                @if ($barang->foto && file_exists(public_path('storage/'.$barang->foto)))
                                    <img src="{{ asset('storage/' . $barang->foto) }}"
                                         id="preview"
                                         class="img-fluid rounded shadow-sm mb-2"
                                         style="max-height:200px; width:100%; object-fit:cover;">
                                @else
                                    <div id="no-photo" class="bg-secondary bg-opacity-10 border rounded py-4 mb-2">
                                        <i class="fa-solid fa-camera fa-2x text-muted"></i>
                                        <p class="small text-muted mb-0">Belum ada foto</p>
                                    </div>
                                    <img id="preview" class="img-fluid rounded shadow-sm mb-2 d-none"
                                         style="max-height:200px; width:100%; object-fit:cover;">
                                @endif
                            </div>

                            <input type="file" name="foto" class="form-control" id="fotoInput" accept="image/*">

                            <small class="text-muted d-block mt-2">
                                JPG, PNG (max 2MB)
                            </small>

                        </div>
                    </div>
                </div>

            </div>

            <hr class="my-4 opacity-50">

            <div class="d-flex justify-content-start gap-2">
                <button type="submit" class="btn btn-warning px-4">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>
                <a href="{{ route('barang.index') }}" class="btn btn-danger px-4">Batal</a>
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

    // LOAD PIC
    function loadPic(divisiId, selectedPic = null) {
        picSelect.innerHTML = '<option>Loading...</option>';

        fetch('/get-pic-by-divisi/' + divisiId)
        .then(res => res.json())
        .then(data => {
            picSelect.innerHTML = '<option value="">-- Pilih PIC --</option>';

            data.forEach(pic => {
                let opt = document.createElement('option');
                opt.value = pic.id;
                opt.textContent = pic.nama_pic;

                if(selectedPic == pic.id) opt.selected = true;

                picSelect.appendChild(opt);
            });
        });
    }

    // INIT
    if (divisiSelect.value) {
        loadPic(divisiSelect.value, "{{ $barang->pic_id }}");
    }

    // CHANGE
    divisiSelect.addEventListener('change', function() {
        loadPic(this.value);
    });

    // STATUS
    const statusSelect = document.getElementById('statusSelect');
    const catatanWrapper = document.getElementById('catatanWrapper');

    statusSelect.addEventListener('change', function() {
        catatanWrapper.style.display = this.value == "0" ? 'block' : 'none';
    });

    // PREVIEW FOTO
    const fotoInput = document.getElementById('fotoInput');
    const preview = document.getElementById('preview');
    const noPhoto = document.getElementById('no-photo');

    fotoInput.onchange = e => {
        const file = e.target.files[0];
        if(file){
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            if(noPhoto) noPhoto.style.display = 'none';
        }
    }

});
</script>
@endsection