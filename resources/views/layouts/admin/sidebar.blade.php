<!-- SIDEBAR -->
<nav id="sidebarMenu" class="sidebar d-lg-block collapse" data-simplebar>
    <div class="sidebar-inner">

        <!-- Brand / Logo -->
        <div class="sidebar-brand">
            <a href="{{ route('dashboard') }}" class="brand-link">
                <div class="brand-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                </div>
                <span class="brand-text">Admin Desa</span>
                <small class="brand-role badge bg-info">{{ auth()->user()->role }}</small>
            </a>
        </div>

        <!-- Navigation Menu -->
        <ul class="nav-menu">

            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('dashboard') }}"
                    class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="3" y="3" width="7" height="7"></rect>
                            <rect x="14" y="3" width="7" height="7"></rect>
                            <rect x="14" y="14" width="7" height="7"></rect>
                            <rect x="3" y="14" width="7" height="7"></rect>
                        </svg>
                    </span>
                    <span class="nav-text">Dashboard</span>
                </a>
            </li>

            <!-- Hanya untuk Admin -->
            @if (auth()->user()->isAdmin())
                <!-- Kategori Pengaduan -->
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}"
                        class="nav-link {{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path
                                    d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z">
                                </path>
                                <line x1="7" y1="7" x2="7.01" y2="7"></line>
                            </svg>
                        </span>
                        <span class="nav-text">Kategori</span>
                    </a>
                </li>

                <!-- Warga -->
                <li class="nav-item">
                    <a href="{{ route('warga.index') }}"
                        class="nav-link {{ request()->routeIs('warga.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                        </span>
                        <span class="nav-text">Data Warga</span>
                    </a>
                </li>

                <!-- User Management -->
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <circle cx="12" cy="12" r="3"></circle>
                                <path
                                    d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z">
                                </path>
                            </svg>
                        </span>
                        <span class="nav-text">Manajemen User</span>
                    </a>
                </li>

                <!-- Penilaian Layanan -->
                <li class="nav-item">
                    <a href="{{ route('penilaian.index') }}"
                        class="nav-link {{ request()->routeIs('penilaian.*') ? 'active' : '' }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <polygon
                                    points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                </polygon>
                            </svg>
                        </span>
                        <span class="nav-text">Penilaian</span>
                    </a>
                </li>
            @endif

            <!-- Untuk Admin dan Petugas -->
            <!-- Pengaduan -->
            <li class="nav-item">
                <a href="{{ route('pengaduan.index') }}"
                    class="nav-link {{ request()->routeIs('pengaduan.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </span>
                    <span class="nav-text">Pengaduan</span>
                </a>
            </li>

            <!-- Tindak Lanjut -->
            <li class="nav-item">
                <a href="{{ route('tindak.index') }}"
                    class="nav-link {{ request()->routeIs('tindak.*') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <polyline points="9 11 12 14 22 4"></polyline>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </span>
                    <span class="nav-text">Tindak Lanjut</span>
                </a>
            </li>
            <!-- Tentang Pengembang -->

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">
                    <span class="nav-icon">
                        <i class="bi bi-person-badge" style="font-size: 1.2rem;"></i>
                    </span>
                    <span class="nav-text">Tentang Pengembang</span>
                </a>
            </li>

        </ul>

        <!-- Logout Button -->
        <div class="sidebar-footer">
            <div class="user-info mb-2 px-3 text-center">
                <small class="text-light">
                    <i class="bi bi-person-badge me-1"></i>
                    {{ auth()->user()->name }}
                    <span class="badge bg-info ms-1">{{ auth()->user()->role }}</span>
                </small>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">
                    <span class="logout-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </span>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </div>
</nav>
<style>
    :root {
        --sidebar-bg: #0f172a;
        --sidebar-bg-light: #1e293b;
        --sidebar-accent: #3b82f6;
        --sidebar-accent-light: #60a5fa;
        --sidebar-text: #f8fafc;
        --sidebar-text-light: #cbd5e1;
        --sidebar-hover: #334155;
        --sidebar-active: #1e40af;
        --sidebar-border: #334155;
        --danger-color: #ef4444;
        --danger-hover: #dc2626;
    }

    .brand-role {
        font-size: 0.6rem;
        margin-left: 0.5rem;
        vertical-align: middle;
    }

    .user-info {
        font-size: 0.8rem;
    }

    /* Sidebar Container */
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 280px;
        background: var(--sidebar-bg);
        z-index: 1000;
        transition: all 0.3s ease;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .sidebar-inner {
        height: 100%;
        display: flex;
        flex-direction: column;
        padding: 1.5rem 0;
    }

    /* Brand */
    .sidebar-brand {
        padding: 0 1.5rem 1.5rem;
        border-bottom: 1px solid var(--sidebar-border);
        margin-bottom: 1.5rem;
    }

    .brand-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        text-decoration: none;
        color: var(--sidebar-text);
        transition: all 0.2s ease;
    }

    .brand-link:hover {
        color: var(--sidebar-accent-light);
    }

    .brand-icon {
        width: 42px;
        height: 42px;
        background: var(--sidebar-accent);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.3);
    }

    .brand-text {
        font-size: 1.25rem;
        font-weight: 700;
        letter-spacing: -0.025em;
    }

    /* Navigation Menu */
    .nav-menu {
        list-style: none;
        padding: 0;
        margin: 0;
        flex: 1;
        overflow-y: auto;
    }

    .nav-item {
        margin-bottom: 0.25rem;
        padding: 0 1rem;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        color: var(--sidebar-text-light);
        text-decoration: none;
        border-radius: 10px;
        transition: all 0.3s ease;
        font-size: 0.9375rem;
        font-weight: 500;
        position: relative;
    }

    .nav-link:hover {
        background: var(--sidebar-hover);
        color: var(--sidebar-text);
        transform: translateX(5px);
    }

    .nav-link.active {
        background: var(--sidebar-active);
        color: white;
        box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3);
    }

    .nav-link.active::before {
        content: '';
        position: absolute;
        left: -1rem;
        top: 0;
        bottom: 0;
        width: 4px;
        background: var(--sidebar-accent-light);
        border-radius: 0 4px 4px 0;
    }

    .nav-link.active .nav-icon {
        color: white;
    }

    .nav-icon {
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--sidebar-text-light);
        transition: color 0.2s ease;
    }

    .nav-text {
        flex: 1;
    }

    /* Sidebar Footer */
    .sidebar-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid var(--sidebar-border);
        margin-top: auto;
    }

    .logout-btn {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.875rem 1rem;
        background: rgba(239, 68, 68, 0.1);
        color: var(--danger-color);
        border: 1px solid rgba(239, 68, 68, 0.2);
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9375rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .logout-btn:hover {
        background: rgba(239, 68, 68, 0.2);
        color: var(--danger-hover);
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(239, 68, 68, 0.2);
    }

    .logout-icon {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Scrollbar Styling */
    .nav-menu::-webkit-scrollbar {
        width: 6px;
    }

    .nav-menu::-webkit-scrollbar-track {
        background: transparent;
    }

    .nav-menu::-webkit-scrollbar-thumb {
        background: var(--sidebar-border);
        border-radius: 3px;
    }

    .nav-menu::-webkit-scrollbar-thumb:hover {
        background: var(--sidebar-hover);
    }

    /* Responsive */
    @media (max-width: 991.98px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }

    /* Content adjustment when sidebar is visible */
    @media (min-width: 992px) {
        .content {
            margin-left: 280px;
        }
    }
</style>
