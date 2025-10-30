@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="container d-flex align-items-center justify-content-center">
        <div class="card auth-card" style="width: 400px;">
            <div class="card-body p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold text-primary">Login Admin</h3>
                    <p class="text-muted">Masuk ke sistem admin desa</p>
                </div>

                @include('layouts.partials.flash-messages')

                <form action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control"
                                placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Masukkan password" required>
                        </div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
                        </button>
                    </div>
                </form>

                <p class="text-center mt-4 mb-0">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none fw-semibold">Daftar di sini</a>
                </p>
            </div>
        </div>
    </div>
@endsection
