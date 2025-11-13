@extends('layouts.app')
@section('title', 'Detail Kategori')

@section('page_actions')
    <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-tag me-2"></i>Detail Kategori Pengaduan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nama Kategori:</div>
                        <div class="col-sm-8">{{ $kategori->nama }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">SLA (Hari):</div>
                        <div class="col-sm-8">
                            <span class="badge bg-info text-dark">
                                <i class="bi bi-clock me-1"></i>{{ $kategori->sla_hari }} hari
                            </span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Prioritas:</div>
                        <div class="col-sm-8">
                            @if ($kategori->prioritas == 'tinggi')
                                <span class="badge bg-danger">
                                    <i class="bi bi-arrow-up-circle me-1"></i>{{ $kategori->prioritas_text }}
                                </span>
                            @elseif($kategori->prioritas == 'sedang')
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-dash-circle me-1"></i>{{ $kategori->prioritas_text }}
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    <i class="bi bi-arrow-down-circle me-1"></i>{{ $kategori->prioritas_text }}
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Dibuat Pada:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $kategori->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
