@extends('layouts.app')
@section('title', 'Detail Penilaian')

@section('page_actions')
    <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-star me-2"></i>Detail Penilaian Layanan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">No Tiket:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-primary">{{ $penilaian->pengaduan->nomor_tiket }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Judul Pengaduan:</div>
                        <div class="col-sm-8">
                            <strong>{{ $penilaian->pengaduan->judul }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Rating:</div>
                        <div class="col-sm-8">
                            <div class="d-flex align-items-center">
                                <div class="text-warning me-3">
                                    {{ $penilaian->rating_bintang }}
                                </div>
                                <div>
                                    <strong>{{ $penilaian->rating_text }}</strong>
                                    <br>
                                    <small class="text-muted">({{ $penilaian->rating }}/5 bintang)</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Komentar:</div>
                        <div class="col-sm-8">
                            @if ($penilaian->komentar)
                                <div class="border p-3 rounded bg-light">
                                    <i class="bi bi-chat-quote me-1 text-muted"></i>
                                    {{ $penilaian->komentar }}
                                </div>
                            @else
                                <span class="text-muted">Tidak ada komentar</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Tanggal Penilaian:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $penilaian->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi Pengaduan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Warga:</strong><br>
                        {{ $penilaian->pengaduan->warga->nama }}
                    </p>
                    <p class="mb-2">
                        <strong>Kategori:</strong><br>
                        <span class="badge bg-info text-dark">
                            {{ $penilaian->pengaduan->kategori->nama ?? '-' }}
                        </span>
                    </p>
                    <p class="mb-2">
                        <strong>Status:</strong><br>
                        @if ($penilaian->pengaduan->status == 'selesai')
                            <span class="badge bg-success">{{ $penilaian->pengaduan->status_text }}</span>
                        @elseif($penilaian->pengaduan->status == 'proses')
                            <span class="badge bg-warning text-dark">{{ $penilaian->pengaduan->status_text }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $penilaian->pengaduan->status_text }}</span>
                        @endif
                    </p>
                    <p class="mb-0">
                        <strong>Lokasi:</strong><br>
                        @if ($penilaian->pengaduan->lokasi_text)
                            {{ $penilaian->pengaduan->lokasi_text }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </p>
                </div>
            </div>

            @if ($penilaian->pengaduan->tindakLanjut)
                <div class="card shadow-sm mt-3">
                    <div class="card-header bg-success text-white">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-clipboard-check me-2"></i>Tindak Lanjut
                        </h6>
                    </div>
                    <div class="card-body">
                        <p class="mb-1">
                            <strong>Petugas:</strong><br>
                            {{ $penilaian->pengaduan->tindakLanjut->petugas }}
                        </p>
                        <p class="mb-0">
                            <strong>Aksi:</strong><br>
                            <small>{{ $penilaian->pengaduan->tindakLanjut->aksi }}</small>
                        </p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
