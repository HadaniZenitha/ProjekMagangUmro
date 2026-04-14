@extends('layouts.dashboard')

@section('page-title', 'Data Item Sewa')
@section('title', 'Data Item Sewa')

@section('content')

<style>
.custom-card{
    border-radius:14px;
    background:#ffffff;
    padding:20px;
    border:1px solid #eaeaea;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}

.btn-clean:hover{
    transform:translateY(-1px);
    background-color:#fbbf24;
}

@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }

    .table td, .table th{
        font-size:13px;
    }
}
</style>

<!-- HEADER -->
<div class="mb-3 d-flex flex-md-row flex-column align-items-md-center">
    
    <h5 class="fw-semibold mb-2 mb-md-0">
        Data Item Sewa
    </h5>

    <a href="{{ route('barang-sewa.create') }}" 
       class="btn btn-warning btn-clean btn-mobile-full ms-md-auto mt-2 mt-md-0">
        <i class="fa-solid fa-plus me-1"></i> Tambah Item
    </a>

</div>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="custom-card">

    <div class="table-responsive">
        <table class="table align-middle table-bordered">

            <thead class="table-light text-center">
                <tr>
                    <th>Kode</th>
                    <th>Nama Item</th>

                    {{-- hide di mobile --}}
                    <th class="d-none d-md-table-cell">PIC</th>
                    <th class="d-none d-md-table-cell">Fungsi</th>
                    <th class="d-none d-md-table-cell">Lokasi</th>
                    <th class="d-none d-md-table-cell">Tahun</th>

                    <th>Kondisi</th>
                    <th>QR</th>
                    <th width="180">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($data as $d)
                <tr>

                    <td class="text-center">
                        <span class="badge bg-dark">{{ $d->kode_barang }}</span>
                    </td>

                    <td>
                        <div class="fw-semibold">{{ $d->nama_barang }}</div>

                        {{-- info tambahan mobile --}}
                        <div class="small text-muted d-md-none">
                            {{ $d->ruang->nama_ruang ?? '-' }}
                        </div>
                    </td>

                    {{-- desktop --}}
                    <td class="d-none d-md-table-cell">{{ $d->pic->nama_pic ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ $d->fungsi ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ $d->ruang->nama_ruang ?? '-' }}</td>
                    <td class="d-none d-md-table-cell">{{ $d->tahun }}</td>

                    <td class="text-center">
                        @if($d->kondisi == 'Baik')
                            <span class="badge bg-success">Baik</span>
                        @elseif($d->kondisi == 'Perlu Perbaikan')
                            <span class="badge bg-warning text-dark">Perlu</span>
                        @else
                            <span class="badge bg-danger">Rusak</span>
                        @endif
                    </td>

                    <td class="text-center">
                        {!! QrCode::size(50)->generate($d->kode_barang) !!}
                    </td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2 flex-wrap">

                            <a href="{{ route('barang-sewa.show', $d->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('barang-sewa.edit', $d->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('barang-sewa.destroy', $d->id) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus barang ini?')" 
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>

                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-3">
                        Belum ada data item sewa.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-3">
        {{ $data->links('pagination::bootstrap-5') }}
    </div>

    </div>

@endsection