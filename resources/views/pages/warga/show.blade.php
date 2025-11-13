@extends('layouts.app')
@section('title', 'Detail Warga')

@section('page_actions')
    <a href="{{ route('warga.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person me-2"></i>Detail Data Warga
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">No KTP:</div>
                        <div class="col-sm-8">
                            <code>{{ $warga->no_ktp }}</code>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nama Lengkap:</div>
                        <div class="col-sm-8">
                            <strong>{{ $warga->nama }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Jenis Kelamin:</div>
                        <div class="col-sm-8">
                            @if ($warga->jenis_kelamin == 'L')
                                <span class="badge bg-primary">
                                    <i class="bi bi-gender-male me-1"></i>{{ $warga->jenis_kelamin_text }}
                                </span>
                            @else
                                <span class="badge bg-danger">
                                    <i class="bi bi-gender-female me-1"></i>{{ $warga->jenis_kelamin_text }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Agama:</div>
                        <div class="col-sm-8">{{ $warga->agama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Pekerjaan:</div>
                        <div class="col-sm-8">{{ $warga->pekerjaan }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Telepon:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-telephone me-1"></i>{{ $warga->telp }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Email:</div>
                        <div class="col-sm-8">
                            @if ($warga->email)
                                <i class="bi bi-envelope me-1"></i>{{ $warga->email }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Dibuat Pada:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $warga->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-info-circle me-2"></i>Informasi
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <i class="bi bi-chat-left-text me-2 text-primary"></i>
                        <strong>Total Pengaduan:</strong>
                        <span class="badge bg-primary">{{ $warga->pengaduan->count() }}</span>
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-clock me-2 text-warning"></i>
                        <strong>Terdaftar Sejak:</strong><br>
                        {{ $warga->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
