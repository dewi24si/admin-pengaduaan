<!-- NAVBAR (Mobile) -->
<nav class="navbar navbar-dark navbar-theme-primary px-4 col-12 d-lg-none">
    <a class="navbar-brand me-lg-5" href="{{ route('dashboard') }}">
        <i class="fas fa-home me-2"></i>
        <span class="fw-bold">Admin Desa</span>
    </a>
    <button class="navbar-toggler d-lg-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</nav>

<!-- TOPBAR (Desktop) -->
<nav class="navbar navbar-expand-lg navbar-light bg-white d-none d-lg-flex border-bottom">
    <div class="container-fluid px-4">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
            <i class="fas fa-home text-primary me-2"></i>
            <span class="fw-bold">Admin Desa</span>
        </a>

        <div class="d-flex align-items-center ms-auto">
            <div class="me-3 text-muted small">
                <i class="fas fa-user me-1"></i>
                Halo, {{ auth()->user()->name ?? 'Admin' }}
            </div>
            <div class="dropdown">
                <a class="btn btn-sm btn-outline-secondary dropdown-toggle d-flex align-items-center" href="#"
                    id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-cog me-1"></i>
                    Akun
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
