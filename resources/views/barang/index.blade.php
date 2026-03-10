@extends('layouts.dashboard')

@section('page-title', 'Data Barang Inventaris')
@section('title', 'Data Barang Inventaris')

@section('content')

<style>

/* ================= BUTTON PROFESSIONAL ================= */

.btn-pro{
border-radius:8px;
font-weight:500;
padding:7px 16px;
box-shadow:0 3px 8px rgba(0,0,0,0.08);
transition:all .25s ease;
border:none;
}

.btn-pro:hover{
transform:translateY(-2px);
box-shadow:0 6px 14px rgba(0,0,0,0.15);
}

.btn-pro:active{
transform:translateY(0);
box-shadow:0 2px 6px rgba(0,0,0,0.1);
}

.btn i{
margin-right:5px;
}


/* ================= TABLE RESPONSIVE ================= */

.table-responsive{
overflow-x:auto;
}

.table th,
.table td{
white-space:nowrap;
vertical-align:middle;
}


/* ================= ACTION BUTTON ================= */

.action-btn{
display:flex;
gap:5px;
flex-wrap:wrap;
}


/* ================= QR SIZE ================= */

.qr-box svg{
width:60px;
height:60px;
}


/* ================= MOBILE RESPONSIVE ================= */

@media (max-width:768px){

.header-flex{
flex-direction:column !important;
align-items:stretch !important;
gap:10px;
}

.header-flex .btn{
width:100%;
}

.table{
font-size:13px;
}

.qr-box svg{
width:45px;
height:45px;
}

.action-btn{
justify-content:center;
}

.pagination{
justify-content:center;
}

}

</style>


<div class="container-fluid">


<!-- HEADER -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4 header-flex">

<h5 class="fw-bold mb-0">Data Barang Inventaris</h5>

<div class="d-flex flex-wrap gap-2">

<a href="{{ route('barang.create') }}" class="btn btn-warning btn-pro">
<i class="fa-solid fa-plus"></i> Tambah Barang
</a>

<button class="btn btn-success btn-pro"
data-bs-toggle="modal"
data-bs-target="#modalImport">

<i class="fas fa-file-excel"></i>
Import Excel

</button>

</div>
</div>


@if(session('success'))
<div class="alert alert-success">
{{ session('success') }}
</div>
@endif



<!-- FILTER -->
<form method="GET" action="{{ route('barang.index') }}">

<div class="card mb-3">

<div class="card-body">

<div class="row g-2">

<div class="col-lg-3 col-md-6 col-12">

<select name="divisi" class="form-select">

<option value="">Semua Divisi</option>

@foreach($divisis as $d)

<option value="{{ $d->id }}"
{{ request('divisi')==$d->id?'selected':'' }}>

{{ $d->nama_divisi }}

</option>

@endforeach

</select>

</div>


<div class="col-lg-3 col-md-6 col-12">

<select name="pic" class="form-select">

<option value="">Semua PIC</option>

@foreach($pics as $p)

<option value="{{ $p->id }}"
{{ request('pic')==$p->id ? 'selected' : '' }}>

{{ $p->nama_pic }}

</option>

@endforeach

</select>

</div>


<div class="col-lg-2 col-md-6 col-12">

<input type="number"
name="tahun"
value="{{ request('tahun') }}"
class="form-control"
placeholder="Tahun">

</div>


<div class="col-lg-2 col-md-6 col-12">

<select name="status" class="form-select">

<option value="">Semua Status</option>

<option value="1"
{{ request('status')==='1'?'selected':'' }}>
Aktif
</option>

<option value="0"
{{ request('status')==='0'?'selected':'' }}>
Nonaktif
</option>

</select>

</div>


<div class="col-lg-2 col-12 d-grid">

<button class="btn btn-primary btn-pro">
Filter
</button>

</div>


<div class="col-lg-3 col-md-6 col-12 d-grid">

<a href="{{ route('barang.exportPreview', request()->query()) }}"
class="btn btn-info btn-pro"
target="_blank">

Preview Excel

</a>

</div>


<div class="col-lg-3 col-md-6 col-12 d-grid">

<a href="{{ route('barang.exportPdf', request()->query()) }}"
class="btn btn-danger btn-pro">

Export PDF

</a>

</div>

</div>

</div>

</div>

</form>



<!-- TABEL -->
<div class="card shadow-sm border-0">

<div class="table-responsive">

<table class="table table-bordered align-middle mb-0">

<thead class="table-light">

<tr>

<th>Kode</th>
<th>PIC</th>
<th>Nama Barang</th>
<th>Lokasi</th>
<th>Tahun</th>
<th>Kondisi</th>
<th>QR</th>
<th width="200">Aksi</th>

</tr>

</thead>


<tbody>

@forelse($barangs as $b)

<tr>

<td>
<span class="badge bg-dark">
{{ $b->kode_barang }}
</span>
</td>

<td>{{ $b->pic->nama_pic ?? '-' }}</td>

<td>{{ $b->nama_barang }}</td>

<td>{{ $b->ruang->nama_ruang ?? '-' }}</td>

<td>{{ $b->tahun_perolehan }}</td>


<td>

@if($b->kondisi == 'baik')

<span class="badge bg-success">Baik</span>

@elseif($b->kondisi == 'perlu_perbaikan')

<span class="badge bg-warning text-dark">
Perlu Perbaikan
</span>

@elseif($b->kondisi == 'rusak')

<span class="badge bg-danger">Rusak</span>

@else

<span class="badge bg-secondary">-</span>

@endif

</td>


<td class="qr-box">
{!! QrCode::size(60)->generate($b->kode_barang) !!}
</td>


<td>

<div class="action-btn">

<a href="{{ route('barang.show',$b->id) }}"
class="btn btn-info btn-sm btn-pro">
<i class="fa-solid fa-eye"></i>
</a>

<a href="{{ route('barang.edit',$b->id) }}"
class="btn btn-warning btn-sm btn-pro">
<i class="fa-solid fa-pen"></i>
</a>

<form action="{{ route('barang.destroy',$b->id) }}"
method="POST">

@csrf
@method('DELETE')

<button onclick="return confirm('Hapus barang ini?')"
class="btn btn-danger btn-sm btn-pro">

<i class="fa-solid fa-trash"></i>

</button>

</form>

</div>

</td>

</tr>

@empty

<tr>
<td colspan="8" class="text-center text-muted">
Data barang belum tersedia
</td>
</tr>

@endforelse

</tbody>

</table>

</div>

</div>



<!-- PAGINATION -->
<div class="mt-3 d-flex justify-content-center">
{{ $barangs->links() }}
</div>



<!-- MODAL IMPORT -->
<div class="modal fade" id="modalImport" tabindex="-1">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<h5 class="modal-title">
Import Data Barang
</h5>

<button class="btn-close"
data-bs-dismiss="modal"></button>

</div>


<form action="{{ route('barang.import') }}"
method="POST"
enctype="multipart/form-data">

@csrf

<div class="modal-body">

<input type="file"
class="form-control"
name="file_excel"
accept=".xlsx,.xls,.csv"
required>

<small class="text-muted">
Format: .xlsx / .xls / .csv
</small>

</div>


<div class="modal-footer">

<button class="btn btn-secondary"
data-bs-dismiss="modal">

Batal

</button>

<button class="btn btn-primary btn-pro">
Import
</button>

</div>

</form>

</div>
</div>
</div>


</div>

@endsection