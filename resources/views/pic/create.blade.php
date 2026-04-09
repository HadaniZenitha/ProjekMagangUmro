@extends('layouts.dashboard')

@section('title', 'Tambah PIC')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah PIC Baru</h5>
    <a href="{{ route('pic.index') }}">
        <i class="fa-solid fa-arrow-left"></i> Kembali
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

        <form method="POST" action="{{ route('pic.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Fungsi</label>
                <select name="divisi_id" class="form-control" required>
                    @foreach($divisis as $d)
                        <option value="{{ $d->id }}">
                            {{ $d->nama_divisi }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama PIC</label>
                <input type="text"
                       name="nama_pic"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">NID PIC <span class="text-danger">*</span></label>
                <input type="text"
                       name="nid_pic"
                       class="form-control"
                       maxlength="10"
                       placeholder="12345678AB"
                       required>
                <small class="text-muted">
                    Format: 8 angka + 2 huruf
                </small>
            </div>

            <div class="mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text"
                       name="jabatan"
                       class="form-control">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">No. HP</label>
                    <input type="text" name="no_hp" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i>Simpan
                </button>
                <a href="{{ route('pic.index') }}" class="btn btn-danger">
                    Batal
                </a>
            </div>

        </form>

    </div>
</div>

@endsection