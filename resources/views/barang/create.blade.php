@extends('layouts.dashboard')

@section('title', 'Tambah Barang Inventaris')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
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
                <label class="form-label">Nama Barang</label>
                <input type="text" name="nama_barang"
                       class="form-control" required>
            </div>

            {{-- Divisi --}}
            <div class="mb-3">
                <label class="form-label">Divisi</label>
                <select name="divisi_id" class="form-control" required>
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
                <select name="pic_id" id="picSelect" class="form-control" required>
                    <option value="">-- Pilih PIC --</option>
                    {{-- @foreach($pics as $p)
                    <option value="{{ $p->id }}">
                        {{ $p->nama_pic }} 
                        ({{ $p->divisi->nama_divisi }})
                    </option>
                   @endforeach --}}
                </select>
            </div>

            <!-- Sub Jenis -->
            <div class="mb-3">
                <label class="form-label">Sub Jenis Barang</label>
                <select name="sub_jenis_barang_id" class="form-control" required>
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
                <select name="ruang_id" class="form-control" required>
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
            <div class="mb-3">
                <label class="form-label">Kondisi Barang</label>
                <select name="keterangan" class="form-control">
                    <option>Baik</option>
                    <option>Rusak</option>
                    <option>Perlu Perbaikan</option>
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('barang.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>
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
