@extends('layouts.app')
@section('title', 'Data Warga')

@section('page_actions')
    <a href="{{ route('warga.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Warga
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
                            <th>No KTP</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>Pekerjaan</th>
                            <th>Telepon</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $i => $row)
                            <tr>
                                <td>{{ ($warga->currentPage() - 1) * $warga->perPage() + $i + 1 }}</td>
                                <td>{{ $row->no_ktp }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->jenis_kelamin_text }}</td>
                                <td>{{ $row->agama }}</td>
                                <td>{{ $row->pekerjaan }}</td>
                                <td>{{ $row->telp }}</td>
                                <td>{{ $row->email ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('warga.edit', $row->warga_id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $row->warga_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data warga ini?')"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">
                                    <i class="bi bi-people display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data warga</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if ($warga->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $warga->firstItem() }} - {{ $warga->lastItem() }} dari {{ $warga->total() }} data
                    </div>
                    {{ $warga->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
