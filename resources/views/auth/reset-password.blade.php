@extends('layouts.auth')

@section('title', 'Reset Password')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <!-- Logo -->
                    <div class="text-center mb-4">

                        <img src="{{ asset('assets/frontend/images/logo.png') }}"
                             alt="Phronesis Water"
                             height="70"
                             class="mb-3">

                        <h2 class="fw-bold">
                            Reset Password
                        </h2>

                        <p class="text-muted">
                            Create a new secure password for your account.
                        </p>

                    </div>

                    <form method="POST" action="{{ route('password.store') }}">

                        @csrf

                        <!-- Password Reset Token -->
                        <input type="hidden"
                               name="token"
                               value="{{ request()->route('token') }}">

                        <!-- Email -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-envelope"></i>
                                </span>

                                <input
                                    type="email"
                                    name="email"
                                    value="{{ old('email', request('email')) }}"
                                    class="form-control @error('email') is-invalid @enderror"
                                    required
                                    autofocus>

                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        <!-- Password -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                New Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Enter new password"
                                    required>

                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Confirm Password
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </span>

                                <input
                                    type="password"
                                    name="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    required>

                            </div>

                        </div>

                        <!-- Submit -->
                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-pill">

                                <i class="fas fa-key me-2"></i>

                                Reset Password

                            </button>

                        </div>

                    </form>

                    <hr class="my-4">

                    <div class="text-center">

                        <a href="{{ route('login') }}"
                           class="text-decoration-none fw-semibold">

                            <i class="fas fa-arrow-left me-2"></i>

                            Back to Login

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection