@extends('layouts.dashboard')

@section('title', 'Edit Barang Inventaris')

@section('content')

<div class="mb-4">
    <h5 class="fw-bold mb-0">Edit Barang Inventaris</h5>
</div>

{{-- Error Validasi --}}
@if ($errors->any())
<div class="alert alert-danger">
<<<<<<< HEAD
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
=======
<ul class="mb-0">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
</div>
@endif


<div class="card shadow-sm border-0">
<div class="card-body">

<form method="POST" action="{{ route('barang.update', $barang->id) }}">
@csrf
@method('PUT')

{{-- Kode Barang --}}
<div class="mb-3">
<label class="form-label fw-semibold">Kode Barang</label>
<<<<<<< HEAD
<input type="text" class="form-control bg-light" value="{{ $barang->kode_barang }}" readonly>
</div>

{{-- Sub Jenis --}}
<div class="mb-3">
<label class="form-label">Sub Jenis</label>
<input type="text" class="form-control" value="{{ $barang->subjenis->nama_subjenis }}" readonly>
</div>

{{-- Nama Barang --}}
<div class="mb-3">
<label class="form-label fw-semibold">Nama Barang</label>
<input type="text" name="nama_barang" class="form-control"
value="{{ old('nama_barang', $barang->nama_barang) }}" required>
</div>

{{-- PIC --}}
<div class="mb-3">
<label class="form-label">PIC</label>
<select name="pic_id" class="form-select" required>
@foreach($pics as $p)
<option value="{{ $p->id }}" {{ $barang->pic_id == $p->id ? 'selected' : '' }}>
{{ $p->nama_pic }} ({{ $p->divisi->nama_divisi }})
</option>
@endforeach
</select>
</div>

{{-- Merk --}}
<div class="mb-3">
<label class="form-label fw-semibold">Merk</label>
<input type="text" name="merk" class="form-control"
value="{{ old('merk', $barang->merk) }}">
</div>

{{-- Serial Number --}}
<div class="mb-3">
<label class="form-label fw-semibold">Serial Number</label>
<input type="text" name="serial_number" class="form-control"
value="{{ old('serial_number', $barang->serial_number) }}">
</div>

{{-- Tahun --}}
<div class="mb-3">
<label class="form-label fw-semibold">Tahun Perolehan</label>
<input type="number" name="tahun_perolehan" class="form-control"
value="{{ old('tahun_perolehan', $barang->tahun_perolehan) }}">
</div>

{{-- Ruang --}}
<div class="mb-3">
<label class="form-label">Lokasi Ruang</label>
<select name="ruang_id" class="form-select">
@foreach($ruangs as $r)
<option value="{{ $r->id }}" {{ $barang->ruang_id == $r->id ? 'selected' : '' }}>
{{ $r->nama_ruang }}
</option>
@endforeach
</select>
</div>

{{-- Keterangan --}}
<div class="mb-3">
<label class="form-label fw-semibold">Keterangan</label>
<textarea name="keterangan" class="form-control" rows="3">{{ old('keterangan', $barang->keterangan) }}</textarea>
</div>

{{-- Status --}}
<div class="mb-3">
<label class="form-label">Status</label>
<select name="is_active" id="statusSelect" class="form-select" required>

<option value="1" {{ $barang->is_active ? 'selected' : '' }}>
Aktif
</option>

<option value="0" {{ !$barang->is_active ? 'selected' : '' }}>
=======
<input type="text"
class="form-control bg-light"
value="{{ $barang->kode_barang }}"
readonly>
</div>


{{-- Sub Jenis --}}
<div class="mb-3">
<label class="form-label">Sub Jenis</label>
<input type="text"
class="form-control"
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
<label class="form-label">PIC (Penanggung Jawab)</label>
<select name="pic_id" class="form-select" required>

@foreach($pics as $p)

<option value="{{ $p->id }}"
{{ $barang->pic_id == $p->id ? 'selected' : '' }}>

{{ $p->nama_pic }} ({{ $p->divisi->nama_divisi }})

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
<label class="form-label">Lokasi Ruang</label>

<select name="ruang_id" class="form-select">

@foreach($ruangs as $r)

<option value="{{ $r->id }}"
{{ $barang->ruang_id == $r->id ? 'selected' : '' }}>

{{ $r->nama_ruang }}

</option>

@endforeach

</select>

</div>


{{-- KONDISI BARANG --}}
<div class="mb-3">

<label class="form-label fw-semibold">
Kondisi Barang
</label>

<select name="kondisi" class="form-select">

<option value="baik"
{{ $barang->kondisi == 'baik' ? 'selected' : '' }}>
Baik
</option>

<option value="perlu_perbaikan"
{{ $barang->kondisi == 'perlu_perbaikan' ? 'selected' : '' }}>
Perlu Perbaikan
</option>

<option value="rusak"
{{ $barang->kondisi == 'rusak' ? 'selected' : '' }}>
Rusak
</option>

</select>

</div>


{{-- Status --}}
<div class="mb-3">

<label class="form-label fw-semibold">
Status
</label>

<select name="is_active"
id="statusSelect"
class="form-select"
required>

<option value="1"
{{ $barang->is_active ? 'selected' : '' }}>
Aktif
</option>

<option value="0"
{{ !$barang->is_active ? 'selected' : '' }}>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
Tidak Aktif
</option>

</select>
<<<<<<< HEAD
</div>

{{-- Catatan Nonaktif --}}
<div class="mb-3" id="catatanWrapper"
style="{{ $barang->is_active ? 'display:none;' : '' }}">

<label>Catatan Nonaktif</label>
=======

</div>


{{-- Catatan Nonaktif --}}
<div class="mb-3"
id="catatanWrapper"
style="{{ $barang->is_active ? 'display:none;' : '' }}">

<label class="form-label">
Catatan Nonaktif
</label>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

<textarea name="catatan_nonaktif"
class="form-control"
rows="3">{{ old('catatan_nonaktif', $barang->catatan_nonaktif) }}</textarea>

</div>

<<<<<<< HEAD
{{-- Tombol --}}
<div class="d-flex gap-2">

<button type="submit" class="btn btn-warning text-dark">
<i class="fa-solid fa-save me-1"></i>
Update
</button>

<a href="{{ route('barang.index') }}" class="btn btn-danger text-dark">
<i class="fa-solid fa-xmark me-1"></i>
Batal
=======

{{-- Tombol --}}
<div class="d-flex gap-2">

<button type="submit"
class="btn btn-warning">

<i class="fa-solid fa-pen me-1 text-dark"></i>
<span class="text-dark">Update</span>

</button>

<a href="{{ route('barang.index') }}"
class="btn btn-danger">

<i class="fa-solid fa-xmark me-1"></i>
Batal

>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
</a>

</div>

</form>

</div>
</div>

<<<<<<< HEAD
=======

>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
<script>

const statusSelect = document.getElementById('statusSelect');
const catatanWrapper = document.getElementById('catatanWrapper');

statusSelect.addEventListener('change', function(){

<<<<<<< HEAD
if(this.value == "0"){
catatanWrapper.style.display = 'block';
}else{
=======
if(this.value == "0") {
catatanWrapper.style.display = 'block';
} else {
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
catatanWrapper.style.display = 'none';
}

});

</script>

@endsection