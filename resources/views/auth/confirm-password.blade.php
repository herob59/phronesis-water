@extends('layouts.auth')

@section('title', 'Confirm Password')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-xl-6 col-lg-7 col-md-9">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <!-- Logo -->
                    <div class="text-center mb-4">

                        <img src="{{ asset('assets/frontend/images/phronesis.jpg') }}"
                             alt="Phronesis Water"
                             height="80"
                             class="mb-3 rounded-circle">

                        <h2 class="fw-bold">
                            Confirm Your Password
                        </h2>

                        <p class="text-muted">
                            For your security, please confirm your password before continuing.
                        </p>

                    </div>

                    <form method="POST" action="{{ route('password.confirm') }}">

                        @csrf

                        <!-- Password -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter your password"
                                    required
                                    autocomplete="current-password">

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-pill">

                                <i class="fas fa-shield-alt me-2"></i>

                                Confirm Password

                            </button>

                        </div>

                    </form>

                    @if (Route::has('password.request'))

                        <div class="text-center mt-4">

                            <a href="{{ route('password.request') }}"
                               class="text-decoration-none">

                                Forgot your password?

                            </a>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection