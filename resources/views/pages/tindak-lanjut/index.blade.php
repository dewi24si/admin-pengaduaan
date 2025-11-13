@extends('layouts.app')
@section('title', 'Tindak Lanjut')

@section('page_actions')
    <a href="{{ route('tindak.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Tindak Lanjut
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No Tiket</th>
                            <th width="23%">Judul Pengaduan</th>
                            <th width="15%">Petugas</th>
                            <th width="25%">Aksi</th>
                            <th width="10%" class="text-center">Foto</th>
                            <th width="10%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tindakLanjut as $i => $row)
                            <tr>
                                <td>{{ ($tindakLanjut->currentPage() - 1) * $tindakLanjut->perPage() + $i + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $row->pengaduan->nomor_tiket }}</span></td>
                                <td><strong>{{ $row->pengaduan->judul }}</strong></td>
                                <td>
                                    <i class="bi bi-person-badge me-1"></i>{{ $row->petugas }}
                                </td>
                                <td>{{ $row->aksi }}</td>
                                <td class="text-center">
                                    @if ($row->foto)
                                        <a href="{{ asset('storage/' . $row->foto) }}" target="_blank"
                                            class="btn btn-sm btn-info" title="Lihat Foto">
                                            <i class="bi bi-image"></i> Lihat
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('tindak.show', $row->tindak_id) }}" class="btn btn-info"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('tindak.edit', $row->tindak_id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('tindak.destroy', $row->tindak_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                onclick="return confirm('Yakin hapus tindak lanjut ini?')"
                                                class="btn btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-clipboard-check display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data tindak lanjut</p>
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
