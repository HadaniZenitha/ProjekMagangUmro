@extends('layouts.dashboard')

@section('title', 'Master Sub Jenis Barang')

@section('content')

<style>
/* ===== CARD CLEAN ===== */
.custom-card{
    border-radius:14px;
    background:#ffffff;
    padding:20px;
    border:1px solid #eaeaea;
    box-shadow:0 4px 12px rgba(0,0,0,0.04);
}

/* ===== BUTTON CLEAN ===== */
.btn-clean{
    border-radius:8px;
    font-weight:500;
    font-size:14px;
    padding:6px 12px;
    box-shadow:none;
    transition:all 0.2s ease;
}

/* WARNA SOFT */
.btn-warning.btn-clean{
    background-color:#facc15;
    border:none;
    color:#000;
}

/* HOVER */
.btn-clean:hover{
    transform:translateY(-1px);
    background-color:#fbbf24;
}

/* MOBILE */
@media (max-width: 768px){
    .btn-mobile-full{
        width:100%;
        text-align:center;
    }
}

.subjenis-toolbar .search-form {
    width: 100%;
}

.subjenis-toolbar .search-input {
    min-width: 0;
}

@media (min-width: 768px){
    .subjenis-toolbar .search-form {
        width: auto;
    }

    .subjenis-toolbar .search-input {
        width: 320px;
    }
}
</style>

<!-- ===== BAGIAN YANG DIPERBAIKI ===== -->
<div class="mb-3 d-flex flex-md-row flex-column align-items-md-center gap-2 subjenis-toolbar">
    <form action="{{ route('subjenis.index') }}" method="GET" class="d-flex flex-column flex-md-row gap-2 mb-2 mb-md-0 search-form">
        <input
            type="text"
            name="search"
            class="form-control search-input"
            placeholder="Search"
            value="{{ request('search') }}"
        >
        <button type="submit" class="btn btn-primary btn-clean">
            <i class="fa-solid fa-magnifying-glass me-1"></i> Cari
        </button>
        @if(request('search'))
            <a href="{{ route('subjenis.index') }}" class="btn btn-secondary btn-clean">Reset</a>
        @endif
    </form>

    <a href="{{ route('subjenis.create') }}" 
       class="btn btn-warning btn-clean btn-mobile-full ms-md-auto mt-2 mt-md-0">
        <i class="fa-solid fa-plus me-1"></i> Tambah Sub Jenis
    </a>

</div>
<!-- ===== END PERBAIKAN ===== -->

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="custom-card">

    <div class="table-responsive">
        <table class="table align-middle table-bordered mb-0">
            <thead class="table-light text-center">
                <tr>
                    <th>Kode</th>
                    <th>Nama Sub Jenis</th>
                    <th>Jenis Barang</th>
                    <th width="220" class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($subjenis as $s)
                <tr>
                    <td>{{ $s->kode_subjenis }}</td>
                    <td>{{ $s->nama_subjenis }}</td>
                    <td class="text-center">{{ $s->jenis->nama_jenis }}</td>

                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2 flex-nowrap">

                            <a href="{{ route('subjenis.show', $s->id) }}"
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('subjenis.edit', $s->id) }}"
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('subjenis.destroy', $s->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button onclick="return confirm('Hapus sub jenis ini?')"
                                        class="btn btn-danger btn-sm">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

<div class="mt-3">
    {{ $subjenis->links('pagination::bootstrap-5') }}
</div>

@endsection