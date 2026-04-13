@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

<div class="container-fluid">

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
    <h5 class="fw-bold mb-0">Data Item Sewa</h5>

    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('barang-sewa.create') }}" class="btn btn-warning btn-pro">
            <i class="fa-solid fa-plus"></i> Tambah Item
        </a>
    </div>
</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

{{-- TABEL --}}
<div class="card shadow-sm border-0">
    <div class="table-responsive">
        <table class="table table-bordered align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Kode</th>
                    <th>PIC</th>
                    <th>Fungsi</th>
                    <th>Nama Item</th>
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
                    <td>
                        <span class="badge bg-dark">{{ $d->kode_barang }}</span>
                    </td>

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

                    {{-- LIHAT --}}
                    <a href="{{ route('barang-sewa.show', $d->id) }}" class="btn btn-info btn-sm btn-pro">
                        <i class="fa-solid fa-eye"></i>
                    </a>

                    {{-- EDIT --}}
                    <a href="{{ route('barang-sewa.edit', $d->id) }}" class="btn btn-warning btn-sm btn-pro">
                        <i class="fa-solid fa-pen"></i>
                    </a>

                    {{-- HAPUS --}}
                    <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus barang ini?')" class="btn btn-danger btn-sm btn-pro">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>

                </div>
            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        <i class="fa-solid fa-box-open fa-2x mb-2 d-block"></i>
                        Data Item sewa belum tersedia
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