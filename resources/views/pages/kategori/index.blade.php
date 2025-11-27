@extends('layouts.app')
@section('title', 'Kategori Pengaduan')

@section('page_actions')
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-8">
                    <form action="{{ route('kategori.index') }}" method="GET" class="row g-2">
                        <div class="col-md-5">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari nama kategori..."
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="prioritas" class="form-select">
                                <option value="">-- Semua Prioritas --</option>
                                <option value="tinggi" {{ request('prioritas') == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                                <option value="sedang" {{ request('prioritas') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="rendah" {{ request('prioritas') == 'rendah' ? 'selected' : '' }}>Rendah</option>
                            </select>
                        </div>

                        <div class="col-md-3 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary">
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
                            <th width="8%">No</th>
                            <th width="40%">Nama Kategori</th>
                            <th width="15%">SLA (Hari)</th>
                            <th width="20%">Prioritas</th>
                            <th width="17%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $i => $row)
                            <tr>
                                <td>{{ ($kategori->currentPage() - 1) * $kategori->perPage() + $i + 1 }}</td>
                                <td>
                                    <i class="bi bi-tag me-2 text-muted"></i>
                                    <strong>{{ $row->nama }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-info text-dark">
                                        <i class="bi bi-clock me-1"></i>{{ $row->sla_hari }} hari
                                    </span>
                                </td>
                                <td>
                                    @if ($row->prioritas == 'tinggi')
                                        <span class="badge bg-danger">
                                            <i class="bi bi-arrow-up-circle me-1"></i>{{ $row->prioritas_text }}
                                        </span>
                                    @elseif($row->prioritas == 'sedang')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-dash-circle me-1"></i>{{ $row->prioritas_text }}
                                        </span>
                                    @else
                                        <span class="badge bg-secondary">
                                            <i class="bi bi-arrow-down-circle me-1"></i>{{ $row->prioritas_text }}
                                        </span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('kategori.show', $row->kategori_id) }}" class="btn btn-info"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('kategori.edit', $row->kategori_id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('kategori.destroy', $row->kategori_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus kategori ini?')"
                                                class="btn btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="bi bi-tags display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data kategori</p>
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
