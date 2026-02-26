@extends('layouts.dashboard')

@section('title', 'Edit Sub Jenis Barang')

@section('content')
<div class="card shadow-sm">
    <div class="card-body">

        <form method="POST" action="{{ route('subjenis.update', $subjenis->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Jenis Barang</label>
                <select name="jenis_barang_id" class="form-control">
                    @foreach($jenisList as $j)
                        <option value="{{ $j->id }}"
                            {{ $subjenis->jenis_barang_id == $j->id ? 'selected' : '' }}>
                            {{ $j->nama_jenis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Nama Sub Jenis</label>
                <input type="text"
                       name="nama_subjenis"
                       value="{{ $subjenis->nama_subjenis }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control">{{ $subjenis->deskripsi }}</textarea>
            </div>

            <button class="btn btn-primary">Update</button>
            <a href="{{ route('subjenis.index') }}" class="btn btn-secondary">
                Kembali
            </a>

        </form>

    </div>
</div>
@endsection
