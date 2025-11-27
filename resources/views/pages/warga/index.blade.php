@extends('layouts.app')
@section('title', 'Data Warga')

@section('page_actions')
    <a href="{{ route('warga.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>Tambah Warga
    </a>
@endsection

@section('content')
    <div class="card shadow-sm border-0">
        <div class="card-body">

            {{-- Form Search & Filter --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('warga.index') }}" method="GET" class="row g-2">
                        {{-- Search global --}}
                        <div class="col-md-4">
                            <input type="text" name="search" class="form-control"
                                   placeholder="Cari NIK / nama / telp / email..."
                                   value="{{ request('search') }}">
                        </div>

                        {{-- Filter Jenis Kelamin --}}
                        <div class="col-md-3">
                            <select name="jenis_kelamin" class="form-select">
                                <option value="">-- Semua Jenis Kelamin --</option>
                                <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>

                        {{-- Filter Agama --}}
                        <div class="col-md-3">
                            <input type="text" name="agama" class="form-control"
                                   placeholder="Filter agama..."
                                   value="{{ request('agama') }}">
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('warga.index') }}" class="btn btn-outline-secondary">
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
                            <th width="4%">No</th>
                            <th width="12%">No KTP</th>
                            <th width="18%">Nama</th>
                            <th width="10%">Jenis Kelamin</th>
                            <th width="10%">Agama</th>
                            <th width="15%">Pekerjaan</th>
                            <th width="12%">Telepon</th>
                            <th width="15%">Email</th>
                            <th width="12%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($warga as $i => $row)
                            <tr>
                                <td>{{ ($warga->currentPage() - 1) * $warga->perPage() + $i + 1 }}</td>
                                <td><code>{{ $row->no_ktp }}</code></td>
                                <td><strong>{{ $row->nama }}</strong></td>
                                <td>
                                    @if ($row->jenis_kelamin == 'L')
                                        <span class="badge bg-primary">
                                            <i class="bi bi-gender-male me-1"></i>{{ $row->jenis_kelamin_text }}
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-gender-female me-1"></i>{{ $row->jenis_kelamin_text }}
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $row->agama }}</td>
                                <td>{{ $row->pekerjaan }}</td>
                                <td>
                                    <i class="bi bi-telephone me-1"></i>{{ $row->telp }}
                                </td>
                                <td>
                                    @if ($row->email)
                                        <i class="bi bi-envelope me-1"></i>{{ $row->email }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('warga.show', $row->warga_id) }}" class="btn btn-info"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('warga.edit', $row->warga_id) }}" class="btn btn-warning"
                                            title="Edit">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('warga.destroy', $row->warga_id) }}" method="POST"
                                            class="d-inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('Yakin hapus data warga ini?')"
                                                class="btn btn-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5">
                                    <i class="bi bi-people display-1 text-muted"></i>
                                    <p class="mt-3 text-muted">Belum ada data warga</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
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
