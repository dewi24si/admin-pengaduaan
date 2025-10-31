@extends('layouts.app')
@section('title', 'Penilaian Layanan')

@section('page_actions')
    <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Penilaian
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
                            <th>Judul Pengaduan</th>
                            <th>Rating</th>
                            <th>Komentar</th>
                            <th>Tanggal Penilaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaian as $i => $row)
                            <tr>
                                <td>{{ ($penilaian->currentPage() - 1) * $penilaian->perPage() + $i + 1 }}</td>
                                <td><strong>{{ $row->pengaduan->nomor_tiket }}</strong></td>
                                <td>{{ $row->pengaduan->judul }}</td>
                                <td>
                                    <span class="badge bg-warning text-dark fs-6">
                                        {{ $row->rating_bintang }}
                                    </span>
                                    <br>
                                    <small class="text-muted">{{ $row->rating_text }}</small>
                                </td>
                                <td>
                                    @if ($row->komentar)
                                        <span title="{{ $row->komentar }}">
                                            {{ Str::limit($row->komentar, 50) }}
                                        </span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $row->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('penilaian.edit', $row->penilaian_id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('penilaian.destroy', $row->penilaian_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus penilaian ini?')"
                                                class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">
                                    <i class="bi bi-star display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data penilaian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($penilaian->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $penilaian->firstItem() }} - {{ $penilaian->lastItem() }} dari
                        {{ $penilaian->total() }} data
                    </div>
                    {{ $penilaian->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
