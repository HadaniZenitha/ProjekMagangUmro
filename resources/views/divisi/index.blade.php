@extends('layouts.dashboard')

@section('title', 'Master Divisi')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Master Divisi</h5>
    <a href="{{ route('divisi.create') }}" class="btn btn-warning">
        <i class="fa-solid fa-plus"></i> Tambah Divisi
    </a>
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
                        <th>Nama Divisi</th>
                        <th>Status</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($divisis as $d)
                    <tr>
                        <td>{{ $d->kode_divisi }}</td>
                        <td>{{ $d->nama_divisi }}</td>
                        <td>
                            @if($d->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('divisi.show', $d->id) }}" 
                               class="btn btn-info btn-sm">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            <a href="{{ route('divisi.edit', $d->id) }}" 
                               class="btn btn-warning btn-sm">
                                <i class="fa-solid fa-pen"></i>
                            </a>

                            <form action="{{ route('divisi.destroy', $d->id) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Hapus divisi ini?')" 
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

    </div>
</div>

@endsection