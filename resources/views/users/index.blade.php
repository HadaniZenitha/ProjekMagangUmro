@extends('layouts.dashboard')

@section('title', 'Management Akun')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold">Daftar User</h4>
    <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-plus me-2"></i>
        Tambah User
    </a>
</div>

@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ $message }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<div class="table-responsive">
    <table class="table table-hover">
        <thead class="table-light">
            <tr>
                <th width="5%">No</th>
                <th>Nama</th>
                <th>NID</th>
                <th>Role</th>
                <th width="15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->nid }}</td>
                    <td>
                        @if ($user->role)
                            <span class="badge bg-primary">{{ ucfirst($user->role) }}</span>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-warning">
                            <i class="fa-solid fa-pencil"></i>
                        </a>
                        <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin hapus?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center text-muted py-4">
                        Tidak ada data user
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection
