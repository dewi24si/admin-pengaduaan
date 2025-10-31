<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon/favicon-32x32.png') }}">

    <!-- Volt CSS -->
    <link href="{{ asset('assets/css/volt.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('assets/css/floating-whatsapp.css') }}" rel="stylesheet">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Include Header -->
    @include('layouts.admin.header')

    <!-- Include Sidebar -->
    @include('layouts.admin.sidebar')

    <!-- CONTENT -->
    <main class="content flex-grow-1">

        <div class="container-fluid p-4">
            <!-- Page Header -->
            @include('layouts.admin.page-header')

            <!-- Flash messages -->
            @include('layouts.admin.flash-messages')

            <!-- Main content -->
            @yield('content')
        </div>
    </main>

    <!-- Include Footer -->
    @include('layouts.admin.footer')

    <!-- JS -->
    <script src="{{ asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- Page-specific scripts -->
    @stack('scripts')
    @yield('scripts')

    <!-- WhatsApp Floating Button -->
    <div class="floating-whatsapp">
        <a href="https://wa.me/{{ config('app.whatsapp_number', '6285156161500') }}?text={{ urlencode('Halo, saya ingin bertanya tentang...') }}" target="_blank" rel="noopener noreferrer" title="Chat via WhatsApp">
            <i class="bi bi-whatsapp"></i>
        </a>
    </div>
</body>

</html>
