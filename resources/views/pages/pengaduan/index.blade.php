@extends('layouts.app')
@section('title', 'Pengaduan')

@section('page_actions')
    <a href="{{ route('pengaduan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Pengaduan
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="4%">No</th>
                            <th width="10%">No Tiket</th>
                            <th width="15%">Warga</th>
                            <th width="22%">Judul</th>
                            <th width="13%">Kategori</th>
                            <th width="12%">Status</th>
                            <th width="14%">Lokasi</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pengaduan as $i => $row)
                            <tr>
                                <td>{{ ($pengaduan->currentPage() - 1) * $pengaduan->perPage() + $i + 1 }}</td>
                                <td><span class="badge bg-secondary">{{ $row->nomor_tiket }}</span></td>
                                <td>
                                    <i class="bi bi-person-circle me-1"></i>{{ $row->warga->nama }}
                                </td>
                                <td><strong>{{ $row->judul }}</strong></td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-tag me-1"></i>{{ $row->kategori->nama ?? '-' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($row->status == 'selesai')
                                        <span class="badge bg-success">
                                            <i class="bi bi-check-circle me-1"></i>{{ $row->status_text }}
                                        </span>
                                    @elseif($row->status == 'proses')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-hourglass-split me-1"></i>{{ $row->status_text }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-circle me-1"></i>{{ $row->status_text }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($row->lokasi_text)
                                        <i class="bi bi-geo-alt me-1"></i>{{ $row->lokasi_text }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('pengaduan.show', $row->pengaduan_id) }}" class="btn btn-info"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('pengaduan.edit', $row->pengaduan_id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('pengaduan.destroy', $row->pengaduan_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus pengaduan ini?')"
                                                class="btn btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5">
                                    <i class="bi bi-chat-left-text display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data pengaduan</p>
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
