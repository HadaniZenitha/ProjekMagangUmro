@extends('layouts.dashboard')

@section('page-title', 'Data Barang Inventaris')
@section('title', 'Data Barang Inventaris')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@section('content')

<style>
.btn-icon {
	align-items: center;
	justify-content: center;
	display: inline-flex;
	padding: 0px;
	width: 38px;
	height: 38px;
	flex-shrink: 0;
}

.btn-icon i {
	margin-right: 0 !important;
	line-height: 1;
}

.btn-pro {
	border-radius: 8px;
	font-weight: 500;
	padding: 7px 16px;
	box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
	transition: all 0.25s ease;
	border: none;
}

.btn-pro:hover {
	transform: translateY(-2px);
	box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
}

.btn-pro:active {
	transform: translateY(0);
	box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.btn i {
	margin-right: 5px;
}

.table-responsive {
	overflow-x: auto;
}

.table th,
.table td {
	white-space: nowrap;
	vertical-align: middle;
}

.action-btn {
	display: flex;
	gap: 8px;
	flex-wrap: wrap;
	flex-wrap: nowrap;
	justify-content: center;
	/* align-items: center; */
}

.qr-box svg {
	width: 60px;
	height: 60px;
}

/* Make Laravel pagination summary and links breathe */
.pagination-wrapper nav > div {
	display: flex;
	align-items: center;
	justify-content: space-between;
	gap: 16px;
	flex-wrap: wrap;
}

.pagination-wrapper p.small {
	margin-bottom: 0;
}

.pagination-wrapper .pagination {
	margin-bottom: 0;
}

@media (max-width: 768px) {
	.header-flex {
		flex-direction: column !important;
		align-items: stretch !important;
		gap: 10px;
	}

	.header-flex .btn {
		width: 100%;
	}

	.table {
		font-size: 13px;
	}

	.qr-box svg {
		width: 45px;
		height: 45px;
	}

	.action-btn {
		justify-content: center;
	}

	.pagination-wrapper nav > div {
		justify-content: center;
	}
}

</style>


<div class="container-fluid">


<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4 header-flex">
	<h5 class="fw-bold mb-0">Data Barang Inventaris</h5>

	<div class="d-flex flex-wrap gap-2">
		<a href="{{ route('barang.create') }}" class="btn btn-warning btn-pro">
			<i class="fa-solid fa-plus"></i> Tambah Barang
		</a>

		<button class="btn btn-success btn-pro" data-bs-toggle="modal" data-bs-target="#modalImport">
			<i class="fas fa-file-excel"></i> Import Excel
		</button>

		<a href="{{ route('barang.scan') }}" class="btn btn-dark btn-pro">
        	<i class="fa-solid fa-qrcode"></i> Scan QR
    	</a>
	</div>
</div>


{{-- ALERT MESSAGES --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session('success') }}
	<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

@if(session('warning'))
<div class="alert alert-warning alert-dismissible fade show">
	<strong>{{ session('warning') }}</strong>

	@if(session('import_errors'))
		<button class="btn btn-sm btn-outline-dark mt-2" type="button" data-bs-toggle="collapse" data-bs-target="#errorDetails">
			<i class="fas fa-eye"></i> Lihat Detail Error
		</button>

		<div class="collapse mt-3" id="errorDetails">
			<div class="table-responsive">
				<table class="table table-sm table-bordered mb-0">
					<thead>
						<tr>
							<th width="80">Baris</th>
							<th>Nama Barang</th>
							<th>Alasan Gagal</th>
						</tr>
					</thead>
					<tbody>
						@foreach(session('import_errors') as $error)
						<tr>
							<td class="text-center">{{ $error['row'] }}</td>
							<td>{{ $error['nama_barang'] }}</td>
							<td><small class="text-danger">{{ $error['reason'] }}</small></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	@endif

	<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif


{{-- FORM FILTER --}}
<form method="GET" action="{{ route('barang.index') }}">
	<div class="card mb-3">
		<div class="card-body">
			<div class="row g-2 align-items-end">
				{{-- <div class="col-lg-3 col-md-6">
					<label class="form-label small mb-1">Fungsi</label>
					<select name="divisi" class="form-select">
						<option value="">Semua Fungsi</option>
						@foreach($divisis as $d)
						<option value="{{ $d->id }}" {{ request('divisi') == $d->id ? 'selected' : '' }}>
							{{ $d->nama_divisi }}
						</option>
						@endforeach
					</select>
				</div> --}}

				<div class="col-lg-3 col-md-6">
				    <label class="form-label small mb-1">Ruangan</label>
				    <select name="ruang" class="form-select select2">
				        <option value="">Semua Ruangan</option>
				        @foreach($ruangs as $r)
				            <option value="{{ $r->id }}" {{ request('ruang') == $r->id ? 'selected' : '' }}>
				                {{ $r->nama_ruang }}
				            </option>
				        @endforeach
				    </select>
				</div>

				<div class="col-lg-3 col-md-6">
					<label class="form-label small mb-1">PIC</label>
					<select name="pic" class="form-select select2">
						<option value="">Semua PIC</option>
						@foreach($pics as $p)
						<option value="{{ $p->id }}" {{ request('pic') == $p->id ? 'selected' : '' }}>
							{{ $p->nama_pic }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-2 col-md-6">
				    <label class="form-label small mb-1">Range Tahun</label>
				    <div class="d-flex gap-2">
				        <input type="number" name="tahun_awal" class="form-control" value="{{ request('tahun_awal', date('Y') - 4) }}" title="Dari Tahun">
				        <span class="align-self-center">-</span>
				        <input type="number" name="tahun_akhir" class="form-control" value="{{ request('tahun_akhir', date('Y')) }}" title="Sampai Tahun">
				    </div>
				</div>

				<div class="col-lg-2 col-md-6">
					<label class="form-label small mb-1">Status</label>
					<select name="status" class="form-select">
						<option value="">Semua Status</option>
						<option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
						<option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Nonaktif</option>
					</select>
				</div>

				<div class="col-lg-2 col-md-12">
					<button type="submit" class="btn btn-primary btn-pro w-100">
						<i class="fa-solid fa-filter"></i> Filter
					</button>
				</div>

				<div class="col-lg-6 col-md-6">
					<a href="{{ route('barang.exportPreview', request()->query()) }}" class="btn btn-info btn-pro w-100" target="_blank">
						<i class="fa-solid fa-eye"></i> Preview Excel
					</a>
				</div>

				<div class="col-lg-6 col-md-6">
					<a href="{{ route('barang.exportPdf', request()->query()) }}" class="btn btn-danger btn-pro w-100">
						<i class="fa-regular fa-file-pdf"></i> Export PDF
					</a>
				</div>
			</div>
		</div>
	</div>

</form>



{{-- TABEL DATA --}}
<div class="card shadow-sm border-0">
	<div class="table-responsive">
		<table class="table table-bordered align-middle mb-0">
			<thead class="table-light">
				<tr class="text-center">
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
						<span class="badge bg-dark">{{ $b->kode_barang }}</span>
					</td>
					<td>{{ $b->pic->nama_pic ?? '-' }}</td>
					<td>{{ $b->nama_barang }}</td>
					<td>{{ $b->ruang->nama_ruang ?? '-' }}</td>
					<td>{{ $b->tahun_perolehan }}</td>
					<td>{{ $b->kondisi ?? '-' }}</td>
					<td class="qr-box">
						{!! QrCode::size(60)->generate(route('barang.show', $b->id)) !!}
					</td>
					<td>
						<div class="action-btn">
							<a href="{{ route('barang.show', $b->id) }}" class="btn btn-info btn-sm btn-pro btn-icon" title="Lihat Detail">
								<i class="fa-solid fa-eye"></i>
							</a>

							<a href="{{ route('barang.edit', $b->id) }}" class="btn btn-warning btn-sm btn-pro btn-icon" title="Edit">
								<i class="fa-solid fa-pen"></i>
							</a>

							<form action="{{ route('barang.destroy', $b->id) }}" method="POST" class="d-inline">
								@csrf
								@method('DELETE')
								<button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm btn-pro btn-icon" title="Hapus">
									<i class="fa-solid fa-trash"></i>
								</button>
							</form>
						</div>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="8" class="text-center text-muted py-4">
						<i class="fa-solid fa-box-open fa-2x mb-2 d-block"></i>
						Data barang belum tersedia
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>

</div>


{{-- PAGINATION --}}
<div class="paginaton-wrapper mt-3">
	{{ $barangs->links('pagination::bootstrap-5') }}
</div>


{{-- MODAL IMPORT EXCEL --}}
<div class="modal fade" id="modalImport" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">

			<div class="modal-header bg-success text-white">
				<h5 class="modal-title">
					<i class="fas fa-file-excel me-2"></i>
					Import Data Barang dari Excel
				</h5>
				<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
			</div>

			<form action="{{ route('barang.import') }}" method="POST" enctype="multipart/form-data">
				@csrf

				<div class="modal-body">
					<div class="mb-3">
						<label class="form-label fw-semibold">Pilih File Excel</label>
						<input type="file" class="form-control" name="file_excel" accept=".xlsx,.xls,.csv" required>
						<small class="text-muted">
							<i class="fa-solid fa-info-circle"></i>
							Format yang didukung: .xlsx, .xls, atau .csv
						</small>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
						<i class="fa-solid fa-xmark"></i> Batal
					</button>
					<button type="submit" class="btn btn-success btn-pro">
						<i class="fas fa-upload"></i> Import Data
					</button>
				</div>
			</form>

		</div>
	</div>
</div>


</div>

@endsection

@section('scripts')

<script>
$(document).ready(function() {
    $('.select2').select2({
        placeholder: "Pilih atau cari...",
        allowClear: true,
        width: '100%'
    });
});
</script>
	
@endsection
