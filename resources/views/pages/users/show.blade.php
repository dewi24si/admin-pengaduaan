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
                    <div class="row align-items-center mb-4">
                        <div class="col-md-4 text-center">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}"
                                class="img-fluid rounded-circle shadow-lg"
                                style="width: 180px; height: 180px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <h2 class="text-primary mb-2">{{ $user->name }}</h2>
                            <p class="mb-3">
                                <i class="bi bi-envelope me-2 text-muted"></i>
                                <strong>Email:</strong> {{ $user->email }}
                            </p>
                            <p class="mb-3">
                                @if ($user->role == 'admin')
                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="bi bi-shield-check me-1"></i>Administrator
                                    </span>
                                @else
                                    <span class="badge bg-info px-3 py-2">
                                        <i class="bi bi-person-workspace me-1"></i>Petugas
                                    </span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-calendar3 me-2"></i>Informasi Akun
                                </h6>
                                <div class="mb-3">
                                    <strong>Dibuat Pada:</strong><br>
                                    <i class="bi bi-calendar3 me-1 text-muted"></i>
                                    {{ $user->created_at->format('d/m/Y H:i') }}
                                </div>
                                <div>
                                    <strong>Terakhir Diupdate:</strong><br>
                                    <i class="bi bi-arrow-clockwise me-1 text-muted"></i>
                                    {{ $user->updated_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-card mb-4">
                                <h6 class="text-primary mb-3">
                                    <i class="bi bi-info-circle me-2"></i>Status
                                </h6>
                                <div class="mb-3">
                                    @if ($user->id == auth()->id())
                                        <span class="badge bg-success px-3 py-2">
                                            <i class="bi bi-person-check me-1"></i>Akun Anda
                                        </span>
                                    @else
                                        <span class="badge bg-secondary px-3 py-2">
                                            <i class="bi bi-person me-1"></i>User Lain
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <strong>Member Selama:</strong><br>
                                    <i class="bi bi-clock-history me-1 text-info"></i>
                                    {{ $user->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-warning text-dark">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-shield-check me-2"></i>Keamanan
                    </h6>
                </div>
                <div class="card-body">
                    <p class="mb-3">
                        <i class="bi bi-key me-2 text-success"></i>
                        <strong>Password:</strong><br>
                        <small class="text-muted">Terkunci dan terenkripsi</small>
                    </p>
                    <p class="mb-0">
                        <i class="bi bi-bell me-2 text-info"></i>
                        <strong>Status Login:</strong><br>
                        <small class="text-muted">Aktif</small>
                    </p>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h6 class="card-title mb-0">
                        <i class="bi bi-lightning-charge me-2"></i>Quick Actions
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Edit User
                        </a>
                        @if ($user->id != auth()->id())
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-grid">
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus user ini?')"
                                    class="btn btn-danger">
                                    <i class="bi bi-trash me-2"></i>Hapus User
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.5rem;
            border-left: 4px solid #4e73df;
        }
    </style>
@endsection
