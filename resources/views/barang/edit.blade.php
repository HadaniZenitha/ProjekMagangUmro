@extends('layouts.dashboard')

@section('title', 'Edit Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0 text-dark">
        Edit Barang Inventaris
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
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kode Barang</label>
                            <input type="text" class="form-control bg-light border-0" value="{{ $barang->kode_barang }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Sub Jenis</label>
                            <input type="text" class="form-control bg-light border-0" value="{{ $barang->subjenis->nama_subjenis }}" readonly>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nama Barang</label>
                        <input type="text" name="nama_barang" class="form-control @error('nama_barang') is-invalid @enderror" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
                    </div>

                    {{-- ROW 1 --}}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Fungsi <span class="text-danger">*</span></label>
                            <select name="divisi_id" id="divisiSelect" class="form-select" required>
                                <option value="">-- Pilih Fungsi --</option>
                                @foreach($divisis as $d)
                                    <option value="{{ $d->id }}"
                                        {{ $barang->divisi_id == $d->id ? 'selected' : '' }}>
                                        {{ $d->nama_divisi }}
                                    </option>
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
                            <input type="number" name="tahun_perolehan" class="form-control" value="{{ old('tahun_perolehan', $barang->tahun_perolehan) }}">
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Kondisi Barang</label>
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

                    <div class="mb-4" id="catatanWrapper" style="{{ $barang->is_active ? 'display:none;' : '' }}">
                        <label class="form-label fw-semibold text-danger">Catatan Nonaktif</label>
                        <textarea name="catatan_nonaktif" class="form-control border-danger" rows="3" placeholder="Alasan barang dinonaktifkan...">{{ old('catatan_nonaktif', $barang->catatan_nonaktif) }}</textarea>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card bg-light border-0 h-100">
                        <div class="card-body text-center">
                            <label class="form-label fw-semibold d-block text-start mb-3">Foto Barang</label>
                            
                            <div class="mb-3">
                                @if ($barang->foto)
                                    <img src="{{ asset('storage/' . $barang->foto) }}" 
                                         id="preview" class="img-fluid rounded shadow-sm mb-2" 
                                         style="max-height: 200px; width: 100%; object-fit: cover;">
                                @else
                                    <div id="no-photo" class="bg-secondary bg-opacity-10 border rounded py-4 mb-2">
                                        <i class="fa-solid fa-camera fa-2x text-muted"></i>
                                        <p class="small text-muted mb-0">Belum ada foto</p>
                                    </div>
                                    <img id="preview" class="img-fluid rounded shadow-sm mb-2 d-none" style="max-height: 200px; width: 100%; object-fit: cover;">
                                @endif
                            </div>

                            <div class="input-group input-group-sm">
                                <input type="file" name="foto" class="form-control" id="fotoInput" accept="image/*">
                            </div>
                            <small class="text-muted d-block mt-2" style="font-size: 0.75rem;">
                                Format: JPG, PNG, WEBP (Maks. 2MB). Biarkan kosong jika tidak ingin mengubah foto.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4 opacity-50">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-danger px-4">Batal</a>
                <button type="submit" class="btn btn-warning px-4 fw-bold">
                    <i class="fa-solid fa-save me-1"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // 1. Inisialisasi Elemen
    const elements = {
        divisi: document.getElementById('divisiSelect'),
        pic: document.getElementById('picSelect'),
        status: document.getElementById('statusSelect'),
        catatan: document.getElementById('catatanWrapper'),
        foto: document.getElementById('fotoInput'),
        preview: document.getElementById('preview'),
        noPhoto: document.getElementById('no-photo'),
        form: document.querySelector('form')
    };

    // 2. Logika Load PIC (AJAX)
    function loadPic(divisiId, selectedPic = null) {
        if (!divisiId) return;

        elements.pic.innerHTML = '<option value="">Memuat...</option>';
        
        fetch(`/get-pic-by-divisi/${divisiId}`, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.json())
        .then(data => {
            elements.pic.innerHTML = '<option value="">-- Pilih PIC --</option>';
            data.forEach(pic => {
                const option = new Option(pic.nama_pic, pic.id);
                if (selectedPic && selectedPic == pic.id) option.selected = true;
                elements.pic.add(option);
            });
        })
        .catch(() => {
            elements.pic.innerHTML = '<option value="">Gagal memuat data</option>';
        });
    }

    // 3. Logika Tampilan Catatan Nonaktif
    function toggleCatatan() {
        if (elements.status && elements.catatan) {
            elements.catatan.style.display = (elements.status.value === "0") ? 'block' : 'none';
        }
    }

    // 4. Preview Foto
    function handlePreview() {
        if (elements.foto && elements.foto.files[0]) {
            const file = elements.foto.files[0];
            elements.preview.src = URL.createObjectURL(file);
            elements.preview.classList.remove('d-none');
            if (elements.noPhoto) elements.noPhoto.classList.add('d-none');
        }
    }

    // --- EVENT LISTENERS ---

    // Trigger awal saat halaman edit dibuka
    if (elements.divisi && elements.divisi.value) {
        loadPic(elements.divisi.value, "{{ $barang->pic_id }}");
    }
    toggleCatatan();

    // Event saat divisi diubah
    elements.divisi?.addEventListener('change', function() {
        loadPic(this.value);
    });

    // Event saat status diubah
    elements.status?.addEventListener('change', toggleCatatan);

    // Event saat foto dipilih
    elements.foto?.addEventListener('change', handlePreview);

    // Validasi Form sebelum submit
    elements.form?.addEventListener('submit', function(e) {
        // Jika status Nonaktif (0), catatan wajib diisi
        const catatanInput = document.querySelector('textarea[name="catatan_nonaktif"]');
        if (elements.status.value === "0" && (!catatanInput.value || catatanInput.value.trim() === "")) {
            e.preventDefault();
            alert('Mohon isi catatan alasan penonaktifan barang.');
            catatanInput.focus();
        }
    });
});
</script>
@endsection
