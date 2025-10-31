@extends('layouts.app')
@section('title', 'Tindak Lanjut')

@section('page_actions')
    <a href="{{ route('tindak.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Tindak Lanjut
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
                            <th>No Tiket Pengaduan</th>
                            <th>Judul Pengaduan</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tindakLanjut as $i => $row)
                            <tr>
                                <td>{{ ($tindakLanjut->currentPage() - 1) * $tindakLanjut->perPage() + $i + 1 }}</td>
                                <td><strong>{{ $row->pengaduan->nomor_tiket }}</strong></td>
                                <td>{{ $row->pengaduan->judul }}</td>
                                <td>{{ $row->petugas }}</td>
                                <td>{{ $row->aksi }}</td>
                                <td>
                                    @if ($row->foto)
                                        <a href="{{ asset('storage/' . $row->foto) }}" target="_blank"
                                            class="btn btn-sm btn-info">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('tindak.edit', $row->tindak_id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('tindak.destroy', $row->tindak_id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus tindak lanjut ini?')"
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
                                    <i class="bi bi-clipboard-check display-4 text-muted"></i>
                                    <p class="mt-2 text-muted">Belum ada data tindak lanjut</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($tindakLanjut->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-muted">
                        Menampilkan {{ $tindakLanjut->firstItem() }} - {{ $tindakLanjut->lastItem() }} dari
                        {{ $tindakLanjut->total() }} data
                    </div>
                    {{ $tindakLanjut->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
