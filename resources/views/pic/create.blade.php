@extends('layouts.dashboard')

@section('title', 'Tambah PIC')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h5 class="fw-bold mb-0">Tambah PIC</h5>
    <a href="{{ route('pic.index') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left me-1"></i>Kembali
    </a>
</div>

<div class="card shadow-sm border-0">
    <div class="card-body">

        <form method="POST" action="{{ route('pic.store') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Divisi</label>
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
                <label class="form-label">NID Pegawai</label>
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

            <div class="mb-4">
                <label class="form-label">Status</label>
                <select name="is_active" class="form-control">
                    <option value="1">Aktif</option>
                    <option value="0">Nonaktif</option>
                </select>
            </div>

<<<<<<< HEAD
            <div class="d-flex left-content-between mt-3">

                <button type="submit" 
                        class="btn btn-success shadow-sm">
                    <i class="fa-solid fa-floppy-disk me-1"></i> Simpan
                </button>

                <a href="{{ route('pic.index') }}" 
                   class="btn btn-warning shadow-sm text-dark">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali
                </a>

=======
            <div class="d-flex gap-2">
                <button class="btn btn-warning">
                    <i class="fa-solid fa-save me-1"></i>Simpan
                </button>
                <a href="{{ route('pic.index') }}" class="btn btn-danger">
                    Batal
                </a>
>>>>>>> 9f836aaacc1194cb67d2ec309e1305e8278b5b44
            </div>

        </form>

    </div>
</div>

@endsection