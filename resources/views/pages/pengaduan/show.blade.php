@extends('layouts.app')
@section('title', 'Detail Pengaduan')

@section('page_actions')
    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-chat-left-text me-2"></i>Detail Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">No Tiket:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-secondary">{{ $pengaduan->nomor_tiket }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Warga:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-person-circle me-1"></i>{{ $pengaduan->warga->nama }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Judul:</div>
                        <div class="col-sm-8"><strong>{{ $pengaduan->judul }}</strong></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Kategori:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-tag me-1"></i>{{ $pengaduan->kategori->nama ?? '-' }}
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Status:</div>
                        <div class="col-sm-8">
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
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Lokasi:</div>
                        <div class="col-sm-8">
                            @if ($pengaduan->lokasi_text)
                                <i class="bi bi-geo-alt me-1"></i>{{ $pengaduan->lokasi_text }}
                                @if ($pengaduan->rt || $pengaduan->rw)
                                    (RT {{ $pengaduan->rt ?? '-' }}/RW {{ $pengaduan->rw ?? '-' }})
                                @endif
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Deskripsi:</div>
                        <div class="col-sm-8">
                            <div class="border p-3 rounded bg-light">
                                {{ $pengaduan->deskripsi }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Dibuat Pada:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $pengaduan->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            @if ($pengaduan->tindakLanjut)
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-success text-white">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-clipboard-check me-2"></i>Tindak Lanjut
                        </h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Petugas:</strong> {{ $pengaduan->tindakLanjut->petugas }}</p>
                        <p><strong>Aksi:</strong> {{ $pengaduan->tindakLanjut->aksi }}</p>
                        @if ($pengaduan->tindakLanjut->catatan)
                            <p><strong>Catatan:</strong> {{ $pengaduan->tindakLanjut->catatan }}</p>
                        @endif
                    </div>
                </div>
            @endif

            @if ($pengaduan->penilaian)
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-star me-2"></i>Penilaian
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-warning mb-2">
                            {{ $pengaduan->penilaian->rating_bintang }}
                        </div>
                        <p><strong>Rating:</strong> {{ $pengaduan->penilaian->rating_text }}</p>
                        @if ($pengaduan->penilaian->komentar)
                            <p><strong>Komentar:</strong> {{ $pengaduan->penilaian->komentar }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
