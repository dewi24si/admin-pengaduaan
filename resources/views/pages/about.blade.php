<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Pengembang - Sistem Pengaduan Desa</title>

    <!-- Volt CSS -->
    <link href="{{ asset('assets/css/volt.css') }}" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #e8eef5 100%);
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
        }

        .about-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .profile-card {
            background: white;
            border-radius: 24px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .profile-header {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 100%);
            padding: 60px 40px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .profile-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 300px;
            height: 300px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }

        .profile-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.03);
            border-radius: 50%;
        }

        .profile-img {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            border: 6px solid white;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            object-fit: cover;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }

        .profile-name {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .profile-role {
            font-size: 16px;
            opacity: 0.95;
            font-weight: 400;
            letter-spacing: 0.5px;
            position: relative;
            z-index: 1;
        }

        .profile-body {
            padding: 48px 40px;
        }

        .info-section {
            margin-bottom: 40px;
        }

        .info-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-value {
            font-size: 18px;
            color: #1e293b;
            font-weight: 600;
        }

        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 40px 0;
        }

        .social-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 16px;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 16px 24px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border: none;
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }

        .social-link:hover::before {
            transform: translateX(0);
        }

        .social-link:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }

        .social-link i {
            font-size: 20px;
        }

        .social-link.linkedin {
            background: linear-gradient(135deg, #0077b5 0%, #005582 100%);
            color: white;
        }

        .social-link.github {
            background: linear-gradient(135deg, #24292e 0%, #000 100%);
            color: white;
        }

        .social-link.instagram {
            background: linear-gradient(135deg, #833AB4 0%, #E1306C 50%, #FD1D1D 100%);
            color: white;
        }

        .social-link.email {
            background: linear-gradient(135deg, #34a853 0%, #2d8c47 100%);
            color: white;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #475569;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 32px;
            transition: all 0.3s ease;
            padding: 12px 20px;
            border-radius: 12px;
            background: white;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .back-link:hover {
            color: #1e3a8a;
            transform: translateX(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .back-link i {
            font-size: 18px;
        }

        .footer {
            text-align: center;
            padding: 32px 24px;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .about-container {
                margin: 20px auto;
            }

            .profile-header {
                padding: 48px 24px;
            }

            .profile-body {
                padding: 32px 24px;
            }

            .profile-name {
                font-size: 28px;
            }

            .profile-img {
                width: 160px;
                height: 160px;
            }

            .social-links {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <div class="about-container">
        <a href="{{ route('login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i>
            Kembali ke Login / Dashboard
        </a>

        <div class="profile-card">
            <!-- Profile Header -->
            <div class="profile-header">
                <img src="{{ asset('assets/dewi.png') }}" alt="Dewi Mega" class="profile-img">
                <h1 class="profile-name">Dewi Mega</h1>
                <p class="profile-role">Mahasiswa Sistem Informasi</p>
            </div>

            <!-- Profile Body -->
            <div class="profile-body">
                <!-- Academic Information -->
                <div class="info-section">
                    <div class="row">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="info-label">
                                <i class="bi bi-credit-card me-1"></i>NIM
                            </div>
                            <div class="info-value">2457301033</div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-label">
                                <i class="bi bi-mortarboard me-1"></i>Program Studi
                            </div>
                            <div class="info-value">Sistem Informasi</div>
                        </div>
                    </div>
                </div>

                <div class="divider"></div>

                <!-- Social Media & Contact -->
                <div class="info-section">
                    <div class="info-label mb-3">
                        <i class="bi bi-link-45deg me-1"></i>Koneksi & Sosial Media
                    </div>
                    <div class="social-links">
                        <a href="https://www.linkedin.com/in/dewi-mega-b4495a399" target="_blank"
                            class="social-link linkedin">
                            <i class="bi bi-linkedin"></i>
                            LinkedIn
                        </a>
                        <a href="https://github.com/dewi24si" target="_blank" class="social-link github">
                            <i class="bi bi-github"></i>
                            GitHub
                        </a>
                        <a href="https://instagram.com/dewimega318" target="_blank" class="social-link instagram">
                            <i class="bi bi-instagram"></i>
                            Instagram
                        </a>
                        <a href="mailto:dewi.mega@example.com" class="social-link email">
                            <i class="bi bi-envelope-fill"></i>
                            Email
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap JS (if using Volt) -->
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
