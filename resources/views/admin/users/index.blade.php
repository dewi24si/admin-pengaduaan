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
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Tanggal Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $i => $user)
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $i + 1 }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        @if ($user->id != auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Yakin hapus user ini?')"
                                                    class="btn btn-danger">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button class="btn btn-danger" disabled
                                                title="Tidak dapat menghapus akun sendiri">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-person display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data user</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
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
