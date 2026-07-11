@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')

<div class="text-center mb-4">

    <h2 class="fw-bold">
        Create Your Account
    </h2>

    <p class="text-muted">
        Register to access the Water Factory ERP System.
    </p>

</div>

<form method="POST" action="{{ route('register') }}">

    @csrf

    <div class="row">

        <!-- Full Name -->
        <div class="col-md-12 mb-3">

            <label class="form-label">
                Full Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                placeholder="Enter your full name"
                required
                autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Email -->
        <div class="col-md-12 mb-3">

            <label class="form-label">
                Email Address
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="example@email.com"
                required>

            @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Password -->
        <div class="col-md-6 mb-3">

            <label class="form-label">
                Password
            </label>

            <div class="input-group">

                <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control @error('password') is-invalid @enderror"
                    placeholder="Enter password"
                    required>

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('password')">

                    <i class="fa fa-eye"></i>

                </button>

            </div>

            @error('password')
                <div class="text-danger small mt-1">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <!-- Confirm Password -->
        <div class="col-md-6 mb-3">

            <label class="form-label">
                Confirm Password
            </label>

            <div class="input-group">

                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="Confirm password"
                    required>

                <button
                    class="btn btn-outline-secondary"
                    type="button"
                    onclick="togglePassword('password_confirmation')">

                    <i class="fa fa-eye"></i>

                </button>

            </div>

        </div>

    </div>

    <div class="form-check mb-4">

        <input
            class="form-check-input"
            type="checkbox"
            id="terms"
            required>

        <label class="form-check-label" for="terms">

            I agree to the
            <a href="#">Terms & Conditions</a>
            and
            <a href="#">Privacy Policy</a>

        </label>

    </div>

    <button type="submit" class="btn btn-primary w-100">

        <i class="fa fa-user-plus me-2"></i>

        Create Account

    </button>

</form>

<div class="text-center mt-4">

    Already have an account?

    <a href="{{ route('login') }}">

        Login Here

    </a>

</div>

<script>

function togglePassword(id){

    let input = document.getElementById(id);

    input.type = input.type === "password"
        ? "text"
        : "password";

}

</script>

@endsection