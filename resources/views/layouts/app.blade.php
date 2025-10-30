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
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Include Header -->
    @include('layouts.partials.header')

    <!-- Include Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- CONTENT -->
    <main class="content flex-grow-1">

        <div class="container-fluid p-4">
            <!-- Page Header -->
            @include('layouts.partials.page-header')

            <!-- Flash messages -->
            @include('layouts.partials.flash-messages')

            <!-- Main content -->
            @yield('content')
        </div>
    </main>

    <!-- Include Footer -->
    @include('layouts.partials.footer')

    <!-- JS -->
    <script src="{{ asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- Page-specific scripts -->
    @stack('scripts')
    @yield('scripts')
</body>

</html>
