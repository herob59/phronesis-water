<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1">

    <title>@yield('title') | {{ config('app.name', 'Phronesis Water') }}</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-6 col-md-8">

            <div class="card shadow-lg border-0 rounded-4">

                <div class="card-body text-center p-5">

                    <!-- Logo -->

                    <img
                        src="{{ asset('assets/images/phronesis.jpg') }}"
                        alt="Logo"
                        height="80"
                        class="mb-4">

                    <!-- Error Code -->

                    <h1 class="display-1 fw-bold text-primary">

                        @yield('code')

                    </h1>

                    <!-- Error Title -->

                    <h2 class="fw-bold mb-3">

                        @yield('title')

                    </h2>

                    <!-- Error Message -->

                    <p class="text-muted mb-4">

                        @yield('message')

                    </p>

                    <!-- Buttons -->

                    <div class="d-flex justify-content-center gap-3">

                        <a href="{{ url('/') }}"
                           class="btn btn-primary rounded-pill px-4">

                            Home

                        </a>

                        <a href="{{ url()->previous() }}"
                           class="btn btn-outline-secondary rounded-pill px-4">

                            Go Back

                        </a>

                    </div>

                </div>

            </div>

            <div class="text-center mt-4 text-muted">

                © {{ date('Y') }}

                Phronesis Water Factory ERP

            </div>

        </div>

    </div>

</div>

</body>

</html>