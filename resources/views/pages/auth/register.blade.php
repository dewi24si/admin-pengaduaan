@extends('layouts.guest')
@section('title', 'Registrasi')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9">
                <div class="auth-card">
                    <div class="row g-0">
                        <!-- Left Side - Branding -->
                        <div class="col-md-5">
                            <div class="auth-image"
                                style="background-image: url('https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800&q=80');">
                                <div class="auth-image-content">
                                    <div class="logo-circle">
                                        <i class="bi bi-building"></i>
                                    </div>
                                    <h2>Bergabung dengan Kami</h2>
                                    <p>Daftar sebagai admin untuk mengelola sistem pengaduan desa</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Side - Form -->
                        <div class="col-md-7">
                            <div class="auth-form-wrapper">
                                <div class="auth-header">
                                    <h3>Buat Akun Baru</h3>
                                    <p>Daftar sebagai admin sistem</p>
                                </div>

                                @include('layouts.admin.flash-messages')

                                <form action="{{ route('register.post') }}" method="POST">
                                    @csrf

                                    <div class="mb-3">
                                        <label for="name" class="form-label">Nama Lengkap</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-person"></i>
                                            </span>
                                            <input type="text" name="name" id="name" class="form-control"
                                                placeholder="Nama lengkap Anda" value="{{ old('name') }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-envelope"></i>
                                            </span>
                                            <input type="email" name="email" id="email" class="form-control"
                                                placeholder="nama@email.com" value="{{ old('email') }}" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-lock"></i>
                                            </span>
                                            <input type="password" name="password" id="password" class="form-control"
                                                placeholder="Minimal 8 karakter" required>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-check"></i>
                                            </span>
                                            <input type="password" name="password_confirmation" id="password_confirmation"
                                                class="form-control" placeholder="Ketik ulang password" required>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary btn-lg">
                                            Daftar Sekarang
                                        </button>
                                    </div>
                                </form>

                                <div class="auth-footer">
                                    Sudah punya akun?
                                    <a href="{{ route('login') }}">Login di sini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
