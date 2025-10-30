@extends('layouts.app')
@section('title', 'Kategori Pengaduan')

@section('page_actions')
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
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
                            <th>Nama Kategori</th>
                            <th>SLA (Hari)</th>
                            <th>Prioritas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $i => $row)
                            <tr>
                                <td>{{ ($kategori->currentPage() - 1) * $kategori->perPage() + $i + 1 }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->sla_hari }} hari</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $row->prioritas == 'tinggi' ? 'danger' : ($row->prioritas == 'sedang' ? 'warning' : 'secondary') }}">
                                        {{ $row->prioritas_text }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('kategori.edit', $row->kategori_id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $row->kategori_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus kategori ini?')"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <i class="bi bi-tags display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data kategori</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($kategori->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $kategori->firstItem() }} - {{ $kategori->lastItem() }} dari
                        {{ $kategori->total() }} data
                    </div>
                    {{ $kategori->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
