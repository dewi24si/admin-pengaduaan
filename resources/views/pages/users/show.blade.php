@extends('layouts.app')
@section('title', 'Detail User')

@section('page_actions')
    <a href="{{ route('users.index') }}" class="btn btn-secondary">
        <i class="bi bi-arrow-left me-2"></i>Kembali
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-person-badge me-2"></i>Detail Data User
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Avatar:</div>
                        <div class="col-sm-8">
                            <div class="avatar-lg bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Nama User:</div>
                        <div class="col-sm-8">
                            <strong>{{ $user->name }}</strong>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Email:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Tanggal Dibuat:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-calendar3 me-1 text-muted"></i>
                            {{ $user->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4 fw-bold">Terakhir Diupdate:</div>
                        <div class="col-sm-8">
                            <i class="bi bi-arrow-clockwise me-1 text-muted"></i>
                            {{ $user->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 fw-bold">Status:</div>
                        <div class="col-sm-8">
                            @if ($user->id == auth()->id())
                                <span class="badge bg-success">
                                    <i class="bi bi-person-check me-1"></i>Akun Anda
                                </span>
                            @else
                                <span class="badge bg-info">
                                    <i class="bi bi-person me-1"></i>User Lain
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-shield-check me-2"></i>Keamanan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-2">
                        <i class="bi bi-key me-2 text-success"></i>
                        <strong>Password:</strong><br>
                        <small class="text-muted">Terkunci dan terenkripsi</small>
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-clock-history me-2 text-info"></i>
                        <strong>Member Selama:</strong><br>
                        {{ $user->created_at->diffForHumans() }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
