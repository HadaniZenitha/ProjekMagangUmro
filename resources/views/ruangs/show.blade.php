@extends('layouts.dashboard')

@section('title', 'Detail Ruang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Detail Ruang</h5>
    <div>
        <a href="{{ route('ruangs.index') }}" class="btn btn-secondary btn-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('ruangs.edit', $ruang) }}" class="btn btn-warning btn-sm">
            <i class="fa-solid fa-edit"></i> Edit
        </a>
    </div>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <h6 class="text-muted mb-3">Informasi Ruang</h6>
                
                <table class="table table-borderless">
                    <tr>
                        <td width="35%"><strong>Kode Ruang</strong></td>
                        <td>: <strong>{{ $ruang->kode_ruang }}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nama Ruang</strong></td>
                        <td>: {{ $ruang->nama_ruang }}</td>
                    </tr>
                    <tr>
                        <td><strong>Lantai</strong></td>
                        <td>: {{ $ruang->lantai->gedung->kode_gedung ?? '-' }} - Lantai {{ $ruang->lantai->kode_lantai ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jenis Ruangan</strong></td>
                        <td>: {{ $ruang->jenisRuangan->kode_jenis_ruangan ?? '-' }} - {{ $ruang->jenisRuangan->nama_jenis_ruangan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td><strong>Status</strong></td>
                        <td>: 
                            @if($ruang->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Non-Aktif</span>
                            @endif
                        </td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <h6 class="text-muted mb-3">Penanggung Jawab</h6>
                
                <div class="card bg-light border-0">
                    <div class="card-body">
                        @if($ruang->pic)
                            <h5 class="mb-1">{{ $ruang->pic->nama_pic }}</h5>
                            @if($ruang->pic->jabatan)
                                <p class="mb-1 text-muted">{{ $ruang->pic->jabatan }}</p>
                            @endif
                            @if($ruang->pic->no_hp)
                                <p class="mb-1"><i class="fa-solid fa-phone"></i> {{ $ruang->pic->no_hp }}</p>
                            @endif
                            @if($ruang->pic->email)
                                <p class="mb-0"><i class="fa-solid fa-envelope"></i> {{ $ruang->pic->email }}</p>
                            @endif
                        @else
                            <p class="text-muted mb-0">Belum ada PIC default untuk ruangan ini.</p>
                            <small class="text-muted">Saat membuat item, akan menggunakan PIC individu.</small>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi tambahan jika ada -->
        <hr>
        <div class="text-end">
            <small class="text-muted">
                Dibuat: {{ $ruang->created_at->format('d M Y H:i') }} | 
                Diubah: {{ $ruang->updated_at->format('d M Y H:i') }}
            </small>
        </div>

    </div>
</div>

@endsection