@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Statistik Cards -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-uppercase text-muted small mb-2">Total Pengaduan</div>
                            <div class="h3 mb-0 fw-bold">{{ $totalPengaduan }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                                <i class="bi bi-chat-left-text fs-4 text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-uppercase text-muted small mb-2">Total Warga</div>
                            <div class="h3 mb-0 fw-bold">{{ $totalWarga }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle bg-success bg-opacity-10 p-3">
                                <i class="bi bi-people fs-4 text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-uppercase text-muted small mb-2">Kategori Pengaduan</div>
                            <div class="h3 mb-0 fw-bold">{{ $totalKategori }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle bg-info bg-opacity-10 p-3">
                                <i class="bi bi-tags fs-4 text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="text-uppercase text-muted small mb-2">Pengaduan Baru</div>
                            <div class="h3 mb-0 fw-bold">{{ $pengaduanTerbaru->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                                <i class="bi bi-clock-history fs-4 text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold">
                        <i class="bi bi-clock-history me-2 text-primary"></i>Pengaduan Terbaru
                    </h5>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Pengaduan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>No Tiket</th>
                                    <th>Judul</th>
                                    <th>Warga</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengaduanTerbaru as $pengaduan)
                                    <tr>
                                        <td><span class="badge bg-secondary">{{ $pengaduan->nomor_tiket }}</span></td>
                                        <td><strong>{{ $pengaduan->judul }}</strong></td>
                                        <td>
                                            <i class="bi bi-person-circle me-1"></i>{{ $pengaduan->warga->nama }}
                                        </td>
                                        <td>
                                            @if ($pengaduan->status == 'selesai')
                                                <span class="badge bg-success">
                                                    <i class="bi bi-check-circle me-1"></i>{{ $pengaduan->status_text }}
                                                </span>
                                            @elseif($pengaduan->status == 'proses')
                                                <span class="badge bg-warning text-dark">
                                                    <i class="bi bi-hourglass-split me-1"></i>{{ $pengaduan->status_text }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">
                                                    <i class="bi bi-circle me-1"></i>{{ $pengaduan->status_text }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                                            {{ $pengaduan->created_at->format('d/m/Y') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-5">
                                            <i class="bi bi-inbox display-1 text-muted"></i>
                                            <p class="mt-3 text-muted">Belum ada pengaduan</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
