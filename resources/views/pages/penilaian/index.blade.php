@extends('layouts.app')
@section('title', 'Penilaian Layanan')

@section('page_actions')
    <a href="{{ route('penilaian.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Penilaian
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            {{-- Filter & Search --}}
            <div class="row mb-3">
                <div class="col-md-8">
                    <form action="{{ route('penilaian.index') }}" method="GET" class="row g-2">
                        <div class="col-md-6">
                            <input
                                type="text"
                                name="search"
                                class="form-control"
                                placeholder="Cari no tiket / judul pengaduan..."
                                value="{{ request('search') }}"
                            >
                        </div>

                        <div class="col-md-3">
                            <select name="rating" class="form-select">
                                <option value="">-- Semua Rating --</option>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                                        {{ $i }} Bintang
                                    </option>
                                @endfor
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('penilaian.index') }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-repeat"></i>
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Tabel --}}
            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">No Tiket</th>
                            <th width="25%">Judul Pengaduan</th>
                            <th width="13%">Rating</th>
                            <th width="25%">Komentar</th>
                            <th width="12%">Tanggal</th>
                            <th width="8%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($penilaian as $i => $row)
                            <tr>
                                <td>{{ ($penilaian->currentPage() - 1) * $penilaian->perPage() + $i + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $row->pengaduan->nomor_tiket }}</span></td>
                                <td><strong>{{ $row->pengaduan->judul }}</strong></td>
                                <td>
                                    <div class="d-flex flex-column">
                                        <div class="text-warning mb-1">
                                            {{ $row->rating_bintang }}
                                        </div>
                                        <small class="text-muted">{{ $row->rating_text }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if ($row->komentar)
                                        <div class="text-truncate" style="max-width: 250px;" title="{{ $row->komentar }}">
                                            <i class="bi bi-chat-quote me-1"></i>{{ $row->komentar }}
                                        </div>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                                    {{ $row->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('penilaian.show', $row->penilaian_id) }}" class="btn btn-info"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('penilaian.edit', $row->penilaian_id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('penilaian.destroy', $row->penilaian_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus penilaian ini?')"
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
                                    <i class="bi bi-star display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data penilaian</p>
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
