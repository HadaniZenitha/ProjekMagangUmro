@extends('layouts.dashboard')

@section('title', 'Management Akun')

@section('content')

<style>
.btn-icon {
    align-items: center;
    justify-content: center;
    display: inline-flex;
    padding: 0px;
    width: 38px;
    height: 38px;
    flex-shrink: 0;
}

.btn-icon i {
    margin-right: 0 !important;
    line-height: 1;
}

.btn-pro {
    border-radius: 8px;
    font-weight: 500;
    padding: 7px 16px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.08);
    transition: all 0.25s ease;
    border: none;
}

.btn-pro:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
}

.btn-pro:active {
    transform: translateY(0);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
}

.btn i {
    margin-right: 5px;
}

.table-responsive {
    overflow-x: auto;
}

.table th,
.table td {
    white-space: nowrap;
    vertical-align: middle;
}

.action-btn {
    display: flex;
    gap: 8px;
    flex-wrap: nowrap;
    justify-content: center;
}

/* RESPONSIVE */
@media (max-width: 768px) {
    .header-flex {
        flex-direction: column !important;
        align-items: stretch !important;
        gap: 10px;
    }

    .header-flex .btn {
        width: 100%;
    }

    .table {
        font-size: 13px;
    }

    .action-btn {
        justify-content: center;
    }
}
</style>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4 header-flex">
        <h5 class="fw-bold mb-0">Management Akun</h5>

        <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('users.create') }}" class="btn btn-warning btn-pro">
                <i class="fa-solid fa-plus"></i> Tambah User
            </a>
        </div>
    </div>

    {{-- ALERT --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- TABLE -->
    <div class="card shadow-sm border-0">
        <div class="table-responsive">
            <table class="table table-bordered align-middle mb-0">
                <thead class="table-light text-center">
                    <tr>
                        <th width="5%">No</th>
                        <th>Nama</th>
                        <th>NID</th>
                        <th>Role</th>
                        <th width="180">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td class="text-center">
                            {{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}
                        </td>

                        <td><strong>{{ $user->name }}</strong></td>

                        <td>{{ $user->nid }}</td>

                        <td>
                            @if ($user->role)
                                <span class="badge bg-warning text-dark">
                                    {{ ucfirst($user->role) }}
                                </span>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>

                        <td>
                            <div class="action-btn">

                                <a href="{{ route('users.edit', $user) }}" 
                                   class="btn btn-warning btn-sm btn-pro btn-icon" 
                                   title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user) }}" 
                                      method="POST" 
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')

                                    <button onclick="return confirm('Yakin ingin hapus?')" 
                                            class="btn btn-danger btn-sm btn-pro btn-icon" 
                                            title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="fa-solid fa-user-slash fa-2x mb-2 d-block"></i>
                            Data user belum tersedia
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- PAGINATION -->
    <div class="mt-3">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>

</div>

@endsection