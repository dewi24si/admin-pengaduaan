@extends('layouts.app')
@section('title', 'Data User')

@section('page_actions')
    <a href="{{ route('users.create') }}" class="btn btn-primary">
        <i class="bi bi-person-plus me-2"></i>Tambah User
    </a>
@endsection

@section('content')
    <div class="card shadow-sm">
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('users.index') }}" method="GET" class="row g-2 align-items-center">
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control" placeholder="Cari nama / email..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <select name="role" class="form-select">
                                <option value="">-- Semua Role --</option>
                                <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                                <option value="petugas" {{ request('role') == 'petugas' ? 'selected' : '' }}>Petugas
                                </option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <select name="registered" class="form-select">
                                <option value="">-- Semua Tanggal --</option>
                                <option value="today" {{ request('registered') == 'today' ? 'selected' : '' }}>Hari ini
                                </option>
                                <option value="week" {{ request('registered') == 'week' ? 'selected' : '' }}>7 hari
                                    terakhir</option>
                                <option value="month" {{ request('registered') == 'month' ? 'selected' : '' }}>30 hari
                                    terakhir</option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="25%">User</th>
                            <th width="20%">Email</th>
                            <th width="15%">Role</th>
                            <th width="15%">Tanggal</th>
                            <th width="20%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="position-relative me-3">
                                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                                class="rounded-circle"
                                                style="width: 45px; height: 45px; object-fit: cover; border: 2px solid #dee2e6;">
                                            @if ($user->id == auth()->id())
                                                <span
                                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success"
                                                    style="font-size: 0.5rem;">
                                                    <i class="bi bi-person-fill"></i>
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <strong>{{ $user->name }}</strong>
                                            @if ($user->id == auth()->id())
                                                <small class="text-success d-block">(Anda)</small>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->role == 'admin')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-shield-check me-1"></i>Admin
                                        </span>
                                    @else
                                        <span class="badge bg-info">
                                            <i class="bi bi-person-workspace me-1"></i>Petugas
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                                    {{ $user->created_at->format('d/m/Y') }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('users.show', $user->id) }}" class="btn btn-info" title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        @if ($user->id != auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus user ini?')"
                                                    class="btn btn-danger" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-secondary" disabled
                                                title="Tidak dapat menghapus akun sendiri">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <i class="bi bi-person display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $users->firstItem() }} - {{ $users->lastItem() }} dari {{ $users->total() }} data
                    </div>
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
