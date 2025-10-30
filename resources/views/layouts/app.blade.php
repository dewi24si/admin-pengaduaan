<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard') </title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">

    <!-- Volt CSS -->
    <link href="{{ asset('assets/css/volt.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR (Mobile) -->
    <nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
        <a class="navbar-brand me-lg-5" href="{{ route('dashboard') }}">
            <img class="navbar-brand-dark" src="" alt="Volt logo" />
        </a>
        <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class=""></span>
        </button>
    </nav>

    <!-- TOPBAR (Desktop) -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white d-none d-lg-flex border-bottom">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                <img src="{{ asset('assets/img/brand/light.svg') }}" height="22" class="me-2" alt="Logo">
                <span class="fw-bold">Admin</span>
            </a>

            <div class="d-flex align-items-center ms-auto">
                <div class="me-3 text-muted small">Halo, {{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="dropdown">
                    <a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="#" id="userMenu"
                        data-bs-toggle="dropdown" aria-expanded="false">Akun</a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

  
 <!-- SIDEBAR -->
<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <ul class="nav flex-column pt-3 pt-md-0">

            <!-- Header / Judul -->
            <li class="nav-item mb-3 text-center">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center justify-content-center">
                    <span class="sidebar-text fw-bold fs-5">Admin Panel</span>
                </a>
            </li>

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" 
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> 
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Kategori Pengaduan -->
            <li class="nav-item">
                <a href="{{ route('kategori.index') }}" 
                   class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i> 
                    <span>Kategori Pengaduan</span>
                </a>
            </li>

            <!-- Pengaduan -->
            <li class="nav-item">
                <a href="{{ route('pengaduan.index') }}" 
                   class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                    <i class="bi bi-chat-left-text me-2"></i> 
                    <span>Pengaduan</span>
                </a>
            </li>

            <!-- Tindak Lanjut -->
            <li class="nav-item">
                <a href="{{ route('tindak.index') }}" 
                   class="nav-link {{ request()->routeIs('tindak.*') ? 'active' : '' }}">
                    <i class="bi bi-clipboard-check me-2"></i> 
                    <span>Tindak Lanjut</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i> 
                        <span>Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</nav>

    <!-- CONTENT -->
    <main class="content">
        <div class="container-fluid p-4">
            <!-- Page Header -->
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h2 class="h4 mb-0">
                        @yield('page_title', ucfirst(str_replace('-', ' ', request()->segment(1) ?? 'Dashboard')))
                    </h2>
                    @hasSection('page_subtitle')
                        <div class="text-muted small">@yield('page_subtitle')</div>
                    @endif
                </div>
                <div>
                    @hasSection('page_actions')
                        @yield('page_actions')
                    @endif
                </div>
            </div>

            <!-- Flash messages -->
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <!-- Main content -->
            @yield('content')
        </div>
    </main>

    <!-- FOOTER -->
    <footer class="bg-white border-top py-3 mt-4">
        <div class="container-fluid d-flex justify-content-between small">
            <div>© {{ date('Y') }} Volt Panel</div>
            <div class="text-muted">Built with Bootstrap 5</div>
        </div>
    </footer>

    <!-- JS -->
    <script src="{{ asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- Page-specific scripts -->
    @stack('scripts')
    @yield('scripts')
</body>
</html>
