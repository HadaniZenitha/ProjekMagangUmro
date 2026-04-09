@extends('layouts.dashboard')

@section('title', 'Edit Ruang')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Edit Ruang</h5>
    <a href="{{ route('ruangs.index') }}">
    </a>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('ruangs.update', $ruang->id) }}">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Lantai</label>
                    <p class="form-control-static">
                        {{ $ruang->lantai->gedung->kode_gedung ?? '' }} - Lantai {{ $ruang->lantai->kode_lantai ?? '' }}
                    </p>
                    <input type="hidden" name="lantai_id" value="{{ $ruang->lantai_id }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Jenis Ruangan</label>
                    <p class="form-control-static">
                        {{ $ruang->jenisRuangan->kode_jenis_ruangan ?? '' }} - {{ $ruang->jenisRuangan->nama_jenis_ruangan ?? '' }}
                    </p>
                    <input type="hidden" name="jenis_ruangan_id" value="{{ $ruang->jenis_ruangan_id }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Ruang</label>
                <input type="text" 
                       name="nama_ruang" 
                       value="{{ old('nama_ruang', $ruang->nama_ruang) }}"
                       class="form-control" 
                       required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">PIC Default</label>
                <select name="pic_id" class="form-select">
                    <option value="">-- Tidak ada PIC default --</option>
                    @foreach($pics as $pic)
                        <option value="{{ $pic->id }}" 
                            {{ $ruang->pic_id == $pic->id ? 'selected' : '' }}>
                            {{ $pic->nama_pic }} 
                            @if($pic->jabatan) - {{ $pic->jabatan }} @endif
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">PIC ini akan menjadi default saat membuat barang di ruangan ini.</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Status</label>
                <select name="is_active" class="form-select">
                    <option value="1" {{ $ruang->is_active ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ !$ruang->is_active ? 'selected' : '' }}>Non-Aktif</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i> Update
                </button>

                <a href="{{ route('ruangs.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection