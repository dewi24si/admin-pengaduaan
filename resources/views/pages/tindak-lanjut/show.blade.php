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
            <div class="card shadow-sm">
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
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-image me-2"></i>Foto Dokumentasi
                    </h6>
                </div>
                <div class="card-body text-center">
                    @if ($tindak->foto)
                        <a href="{{ asset('storage/' . $tindak->foto) }}" target="_blank">
                            <img src="{{ asset('storage/' . $tindak->foto) }}" alt="Foto Tindak Lanjut"
                                class="img-fluid rounded shadow-sm" style="max-height: 200px;">
                        </a>
                        <div class="mt-2">
                            <a href="{{ asset('storage/' . $tindak->foto) }}" target="_blank"
                                class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-zoom-in me-1"></i>Lihat Full Size
                            </a>
                        </div>
                    @else
                        <div class="text-muted py-4">
                            <i class="bi bi-image display-6"></i>
                            <p class="mt-2 mb-0">Tidak ada foto</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
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
        </div>
    </div>
@endsection
