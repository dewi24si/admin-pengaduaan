@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <!-- Statistik -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengaduan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPengaduan }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-chat-left-text fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Warga</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalWarga }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Kategori Pengaduan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalKategori }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-tags fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pengaduan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pengaduanTerbaru->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pengaduan Terbaru -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaduan Terbaru</h6>
                    <a href="{{ route('pengaduan.create') }}" class="btn btn-sm btn-primary">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Pengaduan
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
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
                                        <td>{{ $pengaduan->nomor_tiket }}</td>
                                        <td>{{ $pengaduan->judul }}</td>
                                        <td>{{ $pengaduan->warga->nama }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $pengaduan->status == 'selesai' ? 'success' : ($pengaduan->status == 'proses' ? 'warning' : 'secondary') }}">
                                                {{ $pengaduan->status_text }}
                                            </span>
                                        </td>
                                        <td>{{ $pengaduan->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Belum ada pengaduan</td>
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
