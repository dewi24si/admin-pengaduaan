<!-- SIDEBAR -->
<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-4 pt-3">
        <ul class="nav flex-column pt-3 pt-md-0">

            <!-- Header / Judul -->
            <li class="nav-item mb-3 text-center">
                <a href="{{ route('dashboard') }}" class="nav-link d-flex align-items-center justify-content-center">
                    <span class="sidebar-text fw-bold fs-5">Admin Desa</span>
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

            <!-- Warga -->
            <li class="nav-item">
                <a href="{{ route('warga.index') }}"
                    class="nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                    <i class="bi bi-people me-2"></i>
                    <span>Data Warga</span>
                </a>
            </li>
            <!-- User Management -->
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-gear me-2"></i>
                    <span>Manajemen User</span>
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

            <!-- Penilaian Layanan -->
            <li class="nav-item">
                <a href="{{ route('penilaian.index') }}"
                    class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                    <i class="bi bi-star me-2"></i>
                    <span>Penilaian Layanan</span>
                </a>
            </li>

            <!-- Logout -->
            <li class="nav-item mt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-right me-2"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </li>

        </ul>
    </div>
</nav>
