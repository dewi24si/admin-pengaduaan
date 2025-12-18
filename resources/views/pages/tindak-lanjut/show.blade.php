@extends('layouts.app')
@section('title', 'Detail Tindak Lanjut')

@section('page_actions')
    <a href="{{ route('tindak.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-clipboard-check me-2"></i>Detail Tindak Lanjut
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">No Tiket:</div>
                        <div class="col-sm-8">
                            <span class="badge bg-primary">{{ $tindak->pengaduan->nomor_tiket }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Judul Pengaduan:</div>
                        <div class="col-sm-8">
                            <strong>{{ $tindak->pengaduan->judul }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Petugas:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-person-badge me-1"></i>{{ $tindak->petugas }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Aksi yang Dilakukan:</div>
                        <div class="col-sm-8">
                            <div class="border p-3 rounded bg-light">
                                {{ $tindak->aksi }}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Catatan:</div>
                        <div class="col-sm-8">
                            @if ($tindak->catatan)
                                <div class="border p-3 rounded bg-light">
                                    {{ $tindak->catatan }}
                                </div>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Dibuat Pada:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $tindak->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- MEDIA FILES SECTION -->
            @if ($mediaFiles && $mediaFiles->count() > 0)
                <div class="card shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-files me-2"></i>File Pendukung
                            <small class="float-end">Total: {{ $mediaFiles->count() }} file</small>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($mediaFiles as $media)
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100 border-0 shadow-sm">
                                        <div class="card-body text-center">
                                            <div class="mb-2">
                                                <i
                                                    class="bi {{ $media->file_icon }} display-4 
                                            {{ $media->is_image ? 'text-success' : 'text-primary' }}"></i>
                                            </div>
                                            <h6 class="card-title text-truncate">{{ $media->caption ?? $media->file_name }}
                                            </h6>
                                            <p class="card-text small text-muted">
                                                {{ strtoupper(pathinfo($media->file_name, PATHINFO_EXTENSION)) }}
                                                <br>
                                                <small>{{ $media->created_at->format('d/m/Y') }}</small>
                                            </p>
                                        </div>
                                        <div class="card-footer bg-transparent border-top-0">
                                            <div class="d-flex justify-content-center gap-2">
                                                <a href="{{ $media->file_url }}" target="_blank"
                                                    class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye me-1"></i>Lihat
                                                </a>
                                                <a href="{{ $media->file_url }}" download
                                                    class="btn btn-sm btn-outline-success">
                                                    <i class="bi bi-download me-1"></i>Unduh
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            @endif
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi Pengaduan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <strong>Warga:</strong><br>
                        {{ $tindak->pengaduan->warga->nama }}
                    </p>
                    <p class="mb-2">
                        <strong>Status:</strong><br>
                        @if ($tindak->pengaduan->status == 'selesai')
                            <span class="badge bg-success">{{ $tindak->pengaduan->status_text }}</span>
                        @elseif($tindak->pengaduan->status == 'proses')
                            <span class="badge bg-warning text-dark">{{ $tindak->pengaduan->status_text }}</span>
                        @else
                            <span class="badge bg-secondary">{{ $tindak->pengaduan->status_text }}</span>
                        @endif
                    </p>
                    <p class="mb-0">
                        <strong>Lokasi:</strong><br>
                        @if ($tindak->pengaduan->lokasi_text)
                            {{ $tindak->pengaduan->lokasi_text }}
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </p>
                </div>
            </div>

            @if ($tindak->pengaduan->penilaian)
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h6 class="card-title mb-0">
                            <i class="bi bi-star me-2"></i>Penilaian
                        </h6>
                    </div>
                    <div class="card-body">
                        <p><strong>Rating:</strong> {{ $tindak->pengaduan->penilaian->rating_bintang }}</p>
                        <p><strong>Status:</strong> {{ $tindak->pengaduan->penilaian->rating_text }}</p>
                        @if ($tindak->pengaduan->penilaian->komentar)
                            <p><strong>Komentar:</strong> {{ $tindak->pengaduan->penilaian->komentar }}</p>
                        @endif
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
