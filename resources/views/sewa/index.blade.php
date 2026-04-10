@extends('layouts.dashboard')

@section('page-title', 'Data Barang Sewa')
@section('title', 'Data Barang Sewa')

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

.action-btn {
	display: flex;
	gap: 8px;
	justify-content: center;
}

.qr-box svg {
	width: 60px;
	height: 60px;
}
</style>

<div class="container-fluid">

{{-- HEADER --}}
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
	<h5 class="fw-bold mb-0">Data Barang Sewa</h5>

	<div class="d-flex flex-wrap gap-2">
		<a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro">
			<i class="fa-solid fa-plus"></i> Tambah Barang
		</a>
	</div>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
	{{ session('success') }}
	<button class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

{{-- FILTER (SEPERTI INVENTARIS) --}}
<form method="GET" action="{{ route('barang-sewa.index') }}">
	<div class="card mb-3">
		<div class="card-body">
			<div class="row g-2 align-items-end">

				<div class="col-lg-3 col-md-6">
					<label class="form-label small mb-1">PIC</label>
					<select name="pic" class="form-select">
						<option value="">Semua PIC</option>
						@foreach($pics as $p)
						<option value="{{ $p->id }}" {{ request('pic') == $p->id ? 'selected' : '' }}>
							{{ $p->nama_pic }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-3 col-md-6">
					<label class="form-label small mb-1">Lokasi</label>
					<select name="ruang" class="form-select">
						<option value="">Semua Ruangan</option>
						@foreach($ruangs as $r)
						<option value="{{ $r->id }}" {{ request('ruang') == $r->id ? 'selected' : '' }}>
							{{ $r->nama_ruang }}
						</option>
						@endforeach
					</select>
				</div>

				<div class="col-lg-2 col-md-6">
					<label class="form-label small mb-1">Tahun</label>
					<input type="number" name="tahun" value="{{ request('tahun') }}" class="form-control">
				</div>

				<div class="col-lg-2 col-md-6">
					<label class="form-label small mb-1">Kondisi</label>
					<select name="kondisi" class="form-select">
						<option value="">Semua</option>
						<option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
						<option value="Perlu Perbaikan" {{ request('kondisi') == 'Perlu Perbaikan' ? 'selected' : '' }}>Perlu Perbaikan</option>
						<option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
					</select>
				</div>

				<div class="col-lg-2 col-md-12">
					<button class="btn btn-primary btn-pro w-100">
						<i class="fa-solid fa-filter"></i> Filter
					</button>
				</div>

			</div>
		</div>
	</div>
</form>

{{-- TABLE --}}
<div class="card shadow-sm border-0">
	<div class="table-responsive">
		<table class="table table-bordered align-middle mb-0">
			<thead class="table-light">
				<tr>
					<th>Kode</th>
					<th>PIC</th>
					<th>Fungsi</th>
					<th>Nama Barang</th>
					<th>Lokasi</th>
					<th>Tahun</th>
					<th>Kondisi</th>
					<th>QR</th>
					<th width="180">Aksi</th>
				</tr>
			</thead>

			<tbody>
				@forelse($data as $d)
				<tr>
					<td><span class="badge bg-dark">{{ $d->kode_barang }}</span></td>
					<td>{{ $d->pic->nama_pic ?? '-' }}</td>
					<td>{{ $d->fungsi ?? '-' }}</td>
					<td>{{ $d->nama_barang }}</td>
					<td>{{ $d->ruang->nama_ruang ?? '-' }}</td>
					<td>{{ $d->tahun }}</td>
					<td>
						@if($d->kondisi == 'Baik')
							<span class="badge bg-success">Baik</span>
						@elseif($d->kondisi == 'Perlu Perbaikan')
							<span class="badge bg-warning text-dark">Perlu Perbaikan</span>
						@else
							<span class="badge bg-danger">Rusak</span>
						@endif
					</td>
					<td class="qr-box">
						{!! QrCode::size(60)->generate($d->kode_barang) !!}
					</td>

					<td>
						<div class="action-btn">
							<a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm btn-pro btn-icon">
								<i class="fa-solid fa-eye"></i>
							</a>

							<a href="{{ route('barang-sewa.edit', $d->id) }}" class="btn btn-warning btn-sm btn-pro btn-icon">
								<i class="fa-solid fa-pen"></i>
							</a>

							<form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST">
								@csrf
								@method('DELETE')
								<button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm btn-pro btn-icon">
									<i class="fa-solid fa-trash"></i>
								</button>
							</form>
						</div>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="9" class="text-center text-muted py-4">
						Data barang sewa belum tersedia
					</td>
				</tr>
				@endforelse
			</tbody>
		</table>
	</div>
</div>

{{-- PAGINATION --}}
<div class="mt-3">
	{{ $data->links('pagination::bootstrap-5') }}
</div>

</div>

@endsection