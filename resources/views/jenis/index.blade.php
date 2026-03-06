@extends('layouts.dashboard')

<<<<<<< HEAD
@section('content')

<div class="container">


<h2 class="mb-3">Master Jenis Barang</h2>

<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('jenis.create') }}" 
       class="btn btn-primary shadow-sm">
        <i class="fa-solid fa-plus me-2"></i> Tambah Jenis
    </a>
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th width="60">No</th>
                        <th>Kode</th>
                        <th>Nama Jenis</th>
                        <th>Kelompok</th>
                        <th>Status</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($jenis as $j)
                    <tr>

                        <td class="text-center">
                            {{ ($jenis->currentPage()-1) * $jenis->perPage() + $loop->iteration }}
                        </td>

                        <td>{{ $j->kode_jenis }}</td>

                        <td>{{ $j->nama_jenis }}</td>

                        <td>{{ $j->kelompok->nama_kelompok ?? '-' }}</td>

                        <td class="text-center">
                            @if($j->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>

                        <td class="text-center">

                            <a href="{{ route('jenis.show', $j->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('jenis.edit', $j->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jenis.destroy', $j->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus jenis ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-3 text-muted">
                            Belum ada data jenis barang yang terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="d-flex flex-column align-items-center mt-3">

            <div class="text-muted mb-2">
                Menampilkan {{ $jenis->firstItem() }} - {{ $jenis->lastItem() }}
                dari {{ $jenis->total() }} data
            </div>

            <div>
                {{ $jenis->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>

        </div>

    </div>
</div>


=======
@section('title', 'Master Jenis Barang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Jenis Barang</h5>
    <a href="{{ route('jenis.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Jenis
    </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
</div>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>Kode</th>
                        <th>Nama Jenis</th>
                        <th>Kelompok</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($jenis as $j)
                    <tr>
                        <td>{{ $j->kode_jenis }}</td>
                        <td>{{ $j->nama_jenis }}</td>
                        <td>{{ $j->kelompok->nama_kelompok }}</td>
                        <td>
                            @if($j->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('jenis.show', $j->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('jenis.edit', $j->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('jenis.destroy', $j->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus jenis ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $jenis->links() }}
        </div>

    </div>
</div>

@endsection