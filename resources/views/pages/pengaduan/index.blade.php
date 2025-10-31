@extends('layouts.app')
@section('title', 'Pengaduan')

@section('page_actions')
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Pengaduan
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
                            <th>No Tiket</th>
                            <th>Warga</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Status</th>
                            <th>Lokasi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan as $i => $row)
                            <tr>
                                <td>{{ ($pengaduan->currentPage() - 1) * $pengaduan->perPage() + $i + 1 }}</td>
                                <td><strong>{{ $row->nomor_tiket }}</strong></td>
                                <td>{{ $row->warga->nama }}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->kategori->nama ?? '-' }}</td>
                                <td>
                                    <span
                                        class="badge bg-{{ $row->status == 'selesai' ? 'success' : ($row->status == 'proses' ? 'warning' : 'secondary') }}">
                                        {{ $row->status_text }}
                                    </span>
                                </td>
                                <td>{{ $row->lokasi_text ?? '-' }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('pengaduan.edit', $row->pengaduan_id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('pengaduan.destroy', $row->pengaduan_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus pengaduan ini?')"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <i class="bi bi-chat-left-text display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data pengaduan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengaduan->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $pengaduan->firstItem() }} - {{ $pengaduan->lastItem() }} dari
                        {{ $pengaduan->total() }} data
                    </div>
                    {{ $pengaduan->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
