@extends('layouts.dashboard')

@section('page-title', 'Data Barang Inventaris')
@section('title', 'Data Barang Inventaris')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Data Barang Inventaris</h4>

    <a href="{{ route('barang.create') }}" 
       class="btn btn-primary shadow-sm">
        <i class="fa-solid fa-plus me-2"></i> Tambah Barang
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>PIC</th>
                        <th>Nama Barang</th>
                        <th>Lokasi</th>
                        <th>Tahun</th>
                        <th>Kondisi</th>
                        <th>QR Code</th>
                        <th width="230">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($barangs as $b)
                    <tr>

                        <!-- Kode -->
                        <td>{{ $b->kode_barang }}</td>

                        <!-- PIC -->
                        <td>
                            @if($b->pic)
                                {{ $b->pic->nama_pic }}
                            @else
                                <span class="text-muted">
                                    <i class="fa-solid fa-circle-chevron-down me-1"></i>
                                    Belum dipilih
                                </span>
                            @endif
                        </td>

                        <!-- Nama Barang -->
                        <td>{{ $b->nama_barang }}</td>

                        <!-- Lokasi -->
                        <td>
                            {{ $b->ruang->nama_ruang ?? '-' }}
                        </td>

                        <!-- Tahun -->
                        <td>{{ $b->tahun_perolehan }}</td>

                        <!-- Kondisi -->
                        <td>
                            @if($b->keterangan == 'Baik')
                                <span class="badge bg-success">
                                    <i class="fa-solid fa-circle-check me-1"></i> Baik
                                </span>

                            @elseif($b->keterangan == 'Perlu Perbaikan')
                                <span class="badge bg-warning text-dark">
                                    <i class="fa-solid fa-screwdriver-wrench me-1"></i> Perlu Perbaikan
                                </span>

                            @elseif($b->keterangan == 'Rusak')
                                <span class="badge bg-danger">
                                    <i class="fa-solid fa-circle-xmark me-1"></i> Rusak
                                </span>

                            @else
                                <span class="badge bg-secondary">
                                    {{ $b->keterangan }}
                                </span>
                            @endif
                        </td>

                        <!-- QR Code -->
                        <td>
                            <div class="text-center">
                                {!! QrCode::size(80)->generate($b->kode_barang) !!}
                            </div>
                        </td>

                        <!-- Aksi -->
                        <td>

                            <!-- Detail -->
                            <a href="{{ route('barang.show', $b->id) }}" 
                               class="btn btn-info btn-sm text-white">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <!-- Edit -->
                            <a href="{{ route('barang.edit', $b->id) }}" 
                               class="btn btn-warning btn-sm text-dark">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <!-- Hapus -->
                            <form action="{{ route('barang.destroy', $b->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus barang ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-3">
                            Belum ada data barang.
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>
</div>

@endsection