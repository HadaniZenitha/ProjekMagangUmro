@extends('layouts.dashboard')

@section('title', 'DASHBOARD UTAMA')

@section('content')

<<<<<<< HEAD
<div class="container-fluid">

{{-- ROW CARD DASHBOARD --}}
<div class="row g-3 mb-4 justify-content-center">

    {{-- BARIS 1: 3 KARTU --}}
    <div class="col-12 col-md-4">
        {{-- TOTAL BARANG --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #309FB0; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-info bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-box text-info fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL BARANG</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarang) }}</h2>
                    <small class="text-muted">Item terdata</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        {{-- TOTAL RUANG --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #F39C12; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-door-open text-warning fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL RUANGAN</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalRuang) }}</h2>
                    <small class="text-muted">Ruang aktif</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        {{-- BARANG RUSAK --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #E74C3C; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-triangle-exclamation text-danger fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">BARANG RUSAK</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarangRusak) }}</h2>
                    <small class="text-muted">Perlu perbaikan</small>
                </div>
            </div>
        </div>
    </div>

    {{-- BARIS 2: 2 KARTU --}}
    <div class="col-12 col-md-6">
        {{-- PERLU PERBAIKAN --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #8E44AD; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-purple bg-opacity-10 p-3 rounded-3 me-3" style="background-color:rgba(142,68,173,0.1)">
                    <i class="fa-solid fa-screwdriver-wrench text-purple fs-3" style="color:#8E44AD"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">BARANG PERLU PERBAIKAN</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalPerluPerbaikan) }}</h2>
                    <small class="text-muted">Menunggu perbaikan</small>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-6">
        {{-- TOTAL BARANG KONDISI BAIK --}}
        <div class="card border-0 shadow-sm h-100" style="border-left:5px solid #28A745; min-height:140px;">
            <div class="card-body d-flex align-items-center p-4">
                <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                    <i class="fa-solid fa-circle-check text-success fs-3"></i>
                </div>
                <div>
                    <h6 class="text-muted mb-1" style="font-size:12px;font-weight:700;letter-spacing:1px;">TOTAL BARANG KONDISI BAIK</h6>
                    <h2 class="mb-0 fw-bold text-dark">{{ number_format($totalBarangBaik) }}</h2>
                    <small class="text-muted">Jumlah barang dalam kondisi baik</small>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- BAGIAN BAWAH --}}
<div class="row g-4">

<div class="row g-3">

    {{-- KIRI: TABEL BARANG TERBARU --}}
    <div class="col-12 col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold text-dark">
                    <i class="fa-solid fa-clock-rotate-left me-2 text-info"></i>
                    Penambahan Terbaru
                </h6>
                <a href="{{ route('barang.index') }}" class="btn btn-sm btn-outline-info fw-bold">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Nama Barang</th>
                                <th>Jenis</th>
                                <th>Lokasi</th>
                                <th>Status</th>
                                <th class="text-center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($barangTerbaru as $barang)
                            <tr>
                                <td class="fw-medium">{{ $barang->nama_barang }}</td>
                                <td>{{ $barang->subjenis->nama_subjenis ?? '-' }}</td>
                                <td>{{ $barang->ruang->nama_ruang ?? '-' }}</td>
                                <td>
                                    @if($barang->keterangan == 'Baik')
                                        <span class="badge bg-success">Baik</span>
                                    @elseif($barang->keterangan == 'Rusak')
                                        <span class="badge bg-danger">Rusak</span>
                                    @elseif($barang->keterangan == 'Perlu Perbaikan')
                                        <span class="badge bg-warning text-dark">Perlu Perbaikan</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $barang->created_at?->format('d M Y') ?? '-' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">Belum ada data barang.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- KANAN: AKSI CEPAT --}}
    <div class="col-12 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold text-dark">Aksi Cepat</h6>
            </div>
            <div class="card-body d-grid gap-2">
                <a href="{{ route('barang.index') }}" class="btn btn-outline-info text-dark fw-bold text-start">
                    <i class="fa-solid fa-plus me-2"></i> Tambah Inventaris
                </a>
                <a href="{{ route('ruangs.index') }}" class="btn btn-outline-warning text-dark fw-bold text-start">
                    <i class="fa-solid fa-door-open me-2"></i> Kelola Ruangan
                </a>
                <hr>
                <p class="small text-muted mb-0">
                    Sistem ini mempermudah monitoring aset secara real-time.
                </p>
            </div>
        </div>
    </div>
=======
<style>

/* ================= CARD DASHBOARD ================= */

.stat-card{
border-radius:16px;
background:#fff;
padding:22px;
border:1px solid #f1f1f1;
box-shadow:0 6px 20px rgba(0,0,0,0.05);
transition:all .3s ease;
height:100%;
}

.stat-card:hover{
transform:translateY(-6px);
box-shadow:0 18px 40px rgba(0,0,0,0.12);
}

.stat-icon{
width:60px;
height:60px;
border-radius:14px;
display:flex;
align-items:center;
justify-content:center;
font-size:24px;
color:white;
flex-shrink:0;
}

/* TEXT */

.stat-title{
font-size:13px;
font-weight:600;
color:#6c757d;
letter-spacing:.5px;
text-transform:uppercase;
}

.stat-value{
font-size:32px;
font-weight:700;
color:#212529;
margin-top:3px;
}

.stat-desc{
font-size:13px;
color:#9aa0a6;
margin-top:3px;
}

/* ICON GRADIENT */

.icon-blue{
background:linear-gradient(135deg,#42a5f5,#1e88e5);
}

.icon-yellow{
background:linear-gradient(135deg,#ffca28,#ffc107);
}

.icon-green{
background:linear-gradient(135deg,#66bb6a,#43a047);
}

.icon-red{
background:linear-gradient(135deg,#ef5350,#e53935);
}

.icon-dark{
background:linear-gradient(135deg,#546e7a,#37474f);
}

/* ================= BUTTON ================= */

.btn-modern{
border-radius:8px;
font-weight:500;
padding:7px 16px;
transition:all .25s ease;
box-shadow:0 3px 10px rgba(0,0,0,0.08);
}

.btn-modern:hover{
transform:translateY(-2px);
box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

/* ================= TABLE ================= */

.table thead{
background:#f8f9fa;
font-weight:600;
}

.table tbody tr:hover{
background:#f1f3f5;
}

/* ================= CARD HEADER ================= */

.card-header{
font-weight:600;
background:#fff;
border-bottom:1px solid #eee;
}

/* ================= QUICK ACTION ================= */

.quick-btn{
text-align:left;
border-radius:8px;
padding:10px 14px;
font-weight:500;
}

/* ================= RESPONSIVE ================= */

@media (max-width:768px){

.stat-value{
font-size:26px;
}

.stat-icon{
width:50px;
height:50px;
font-size:20px;
}

.table{
font-size:13px;
}

}

</style>

<div class="container-fluid">

<!-- ================= CARD ATAS ================= -->

<div class="row g-4 mb-4">

<!-- TOTAL BARANG -->

<div class="col-lg-4 col-md-6 col-12">

<div class="stat-card d-flex align-items-center">

<div class="stat-icon icon-blue me-3">
<i class="fa-solid fa-box"></i>
</div>

<div>
<div class="stat-title">Total Barang</div>
<div class="stat-value">
{{ $totalBarang }} Item
</div>
<div class="stat-desc">
Total seluruh inventaris
</div>
</div>

</div>

</div>

<!-- TOTAL RUANG -->

<div class="col-lg-4 col-md-6 col-12">

<div class="stat-card d-flex align-items-center">

<div class="stat-icon icon-yellow me-3">
<i class="fa-solid fa-door-open"></i>
</div>

<div>
<div class="stat-title">Total Ruangan</div>
<div class="stat-value">
{{ $totalRuang }} Ruang
</div>
<div class="stat-desc">
Ruang yang terdaftar
</div>
</div>

</div>

</div>

<!-- BARANG BAIK -->

<div class="col-lg-4 col-md-6 col-12">

<div class="stat-card d-flex align-items-center">

<div class="stat-icon icon-green me-3">
<i class="fa-solid fa-check"></i>
</div>

<div>
<div class="stat-title">Kondisi Baik</div>
<div class="stat-value">
{{ $barangBaik }} Item
</div>
<div class="stat-desc">
Siap digunakan
</div>
</div>

</div>

</div>

</div>

<!-- ================= CARD BAWAH ================= -->

<div class="row g-4 mb-4">

<!-- PERLU PERBAIKAN -->

<div class="col-lg-6 col-md-6 col-12">

<div class="stat-card d-flex align-items-center">

<div class="stat-icon icon-red me-3">
<i class="fa-solid fa-screwdriver-wrench"></i>
</div>

<div>
<div class="stat-title">Perlu Perbaikan</div>
<div class="stat-value">
{{ $barangPerbaikan }} Item
</div>
<div class="stat-desc">
Menunggu proses perbaikan
</div>
</div>

</div>

</div>

<!-- BARANG RUSAK -->

<div class="col-lg-6 col-md-6 col-12">

<div class="stat-card d-flex align-items-center">

<div class="stat-icon icon-dark me-3">
<i class="fa-solid fa-triangle-exclamation"></i>
</div>

<div>
<div class="stat-title">Barang Rusak</div>
<div class="stat-value">
{{ $barangRusak }} Item
</div>
<div class="stat-desc">
Tidak dapat digunakan
</div>
</div>

</div>

</div>

</div>

<!-- ================= TABEL + AKSI ================= -->

<div class="row g-4">

<!-- TABEL -->

<div class="col-lg-8 col-12">

<div class="card border-0 shadow-sm">

<div class="card-header d-flex justify-content-between align-items-center">

<span>Penambahan Terbaru</span>

<a href="{{ route('barang.index') }}" class="btn btn-primary btn-sm btn-modern">
Lihat Semua
</a>

</div>

<div class="card-body">

<div class="table-responsive">

<table class="table table-hover">

<thead>

<tr>
<th>Nama Barang</th>
<th>Jenis</th>
<th>Lokasi</th>
<th>Status</th>
<th>Tanggal</th>
</tr>

</thead>

<tbody>

@foreach($barangTerbaru as $barang)

<tr>

<td>{{ $barang->nama_barang }}</td>

<td>{{ $barang->subjenis->nama_subjenis ?? '-' }}</td>

<td>{{ $barang->ruang->nama_ruang ?? '-' }}</td>

<td>
<span class="badge bg-success">Aktif</span>
</td>

<td>
{{ $barang->created_at->format('d M Y') }}
</td>

</tr>

@endforeach

</tbody>

</table>
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf

</div>

</div>
<<<<<<< HEAD
@endsection
=======

</div>

</div>

<!-- AKSI CEPAT -->

<div class="col-lg-4 col-12">

<div class="card border-0 shadow-sm h-100">

<div class="card-header">
Aksi Cepat
</div>

<div class="card-body d-grid gap-2">

<a href="{{ route('barang.create') }}" class="btn btn-outline-primary quick-btn btn-modern">
<i class="fa-solid fa-plus"></i> Tambah Inventaris
</a>

<a href="{{ route('barang.index') }}" class="btn btn-outline-secondary quick-btn btn-modern">
<i class="fa-solid fa-box"></i> Lihat Data Barang
</a>

<a href="{{ route('ruangs.index') }}" class="btn btn-outline-warning quick-btn btn-modern">
<i class="fa-solid fa-door-open"></i> Kelola Ruangan
</a>

</div>

</div>

</div>

</div>

</div>

@endsection
>>>>>>> d7302947f020310c79f6a86c9bbc92fdfa6339cf
