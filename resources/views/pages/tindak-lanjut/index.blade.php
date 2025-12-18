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
            {{-- Form Search & Filter --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <form action="{{ route('tindak.index') }}" method="GET" class="row g-2">
                        <div class="col-md-6">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari tiket / judul / petugas / aksi..." value="{{ request('search') }}">
                        </div>

                        <div class="col-md-4">
                            <select name="has_foto" class="form-select">
                                <option value="">-- Semua File --</option>
                                <option value="1" {{ request('has_foto') === '1' ? 'selected' : '' }}>Dengan File
                                </option>
                                <option value="0" {{ request('has_foto') === '0' ? 'selected' : '' }}>Tanpa File
                                </option>
                            </select>
                        </div>

                        <div class="col-md-2 d-flex gap-2">
                            <button type="submit" class="btn btn-outline-primary w-100">
                                <i class="bi bi-search me-1"></i> Filter
                            </button>
                            <a href="{{ route('tindak.index') }}" class="btn btn-outline-secondary">
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
                            <th width="23%">Judul Pengaduan</th>
                            <th width="15%">Petugas</th>
                            <th width="20%">Aksi</th>
                            <th width="10%" class="text-center">File</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tindakLanjut as $i => $row)
                            @php
                                $mediaCount = $row->media()->count();
                            @endphp
                            <tr>
                                <td>{{ ($tindakLanjut->currentPage() - 1) * $tindakLanjut->perPage() + $i + 1 }}</td>
                                <td><span class="badge bg-primary">{{ $row->pengaduan->nomor_tiket }}</span></td>
                                <td><strong>{{ $row->pengaduan->judul }}</strong></td>
                                <td>
                                    <i class="bi bi-person-badge me-1"></i>{{ $row->petugas }}
                                </td>
                                <td>{{ $row->aksi }}</td>
                                <td class="text-center">
                                    @if ($mediaCount > 0)
                                        <span class="badge bg-info" title="{{ $mediaCount }} file">
                                            <i class="bi bi-files me-1"></i>{{ $mediaCount }}
                                        </span>
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
