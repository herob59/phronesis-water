<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Phronesis') }}</title>

    {{-- Vite (Bootstrap, Font Awesome, app.js) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Admin Custom Styles --}}
    <link href="{{ asset('assets/admin/css/styles.css') }}" rel="stylesheet">

    {{-- Page-specific styles --}}
    @stack('styles')
</head>

<body class="sb-nav-fixed">

    {{-- Top Navigation --}}
    @include('layouts.partials.admin.navbar')

    <div id="layoutSidenav">

        {{-- Sidebar --}}
        <div id="layoutSidenav_nav">
            @include('layouts.partials.admin.sidebar')
        </div>

        {{-- Main Content --}}
        <div id="layoutSidenav_content">

            <main class="py-4">
                <div class="container-fluid px-4">

                    @yield('content')

                </div>
            </main>

            {{-- Footer --}}
            @include('layouts.partials.admin.footer')

        </div>

    </div>

    {{-- jQuery (Remove this later if you're not using it) --}}
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"
        integrity="sha256-OaVG6prZf4v69dPg6PhVattBXkcOWQB62pdZ3ORyrao="
        crossorigin="anonymous"></script>

    {{-- Admin Custom Scripts --}}
    <script src="{{ asset('assets/admin/js/scripts.js') }}"></script>

    {{-- Sidebar Toggle --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const sidebarToggle = document.getElementById('sidebarToggle');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.body.classList.toggle('sb-sidenav-toggled');
                });
            }

        });
    </script>

    {{-- Page-specific scripts --}}
    @stack('scripts')

</body>

</html>