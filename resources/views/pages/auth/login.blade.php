@extends('layouts.guest')
@section('title', 'Login')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="auth-card">
                    <div class="row g-0">
                        <!-- Left Side - Branding -->
                        <div class="col-md-5">
                            <div class="auth-image"
                                style="background-image: url('https://images.unsplash.com/photo-1497366216548-37526070297c?w=800&q=80');">
                                <div class="auth-image-content">
                                    <div class="logo-circle">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h2>Sistem Pengaduan Desa</h2>
                                    <p>Kelola pengaduan warga dengan mudah dan efisien</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Form -->
                        <div class="col-md-7">
                            <div class="auth-form-wrapper">
                                <div class="auth-header">
                                    <h3>Selamat Datang</h3>
                                    <p>Masuk ke akun Anda</p>
                                </div>

                                @include('layouts.admin.flash-messages')

                                <form action="{{ route('login.post') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope"></i>
                                            </span>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Masukkan password" required>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Masuk
                                        </button>
                                    </div>
                                </form>

                                <div class="auth-footer">
                                    Belum punya akun?
                                    <a href="{{ route('register') }}">Daftar sebagai Petugas</a>
                                </div>
                                <div class="text-center mt-4 pt-3 border-top">
                                    <a href="{{ route('about') }}" class="text-decoration-none text-muted">
                                        <i class="bi bi-info-circle me-1"></i>Tentang Pengembang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
