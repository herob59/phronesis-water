@extends('layouts.auth')

@section('title','Login')

@section('content')

<div class="text-center mb-4">

    <h2 class="fw-bold">
        Welcome Back
    </h2>

    <p class="text-muted">
        Sign in to continue to your dashboard.
    </p>

</div>

<form method="POST" action="{{ route('login') }}">

    @csrf

    <div class="mb-3">

        <label class="form-label">
            Email Address
        </label>

        <input
            type="email"
            name="email"
            value="{{ old('email') }}"
            class="form-control @error('email') is-invalid @enderror"
            required
            autofocus>

        @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="mb-3">

        <label class="form-label">
            Password
        </label>

        <div class="input-group">

            <input
                id="password"
                type="password"
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required>

            <button
                class="btn btn-outline-secondary"
                type="button"
                onclick="togglePassword()">

                <i class="fa fa-eye"></i>

            </button>

        </div>

        @error('password')
            <div class="text-danger small">
                {{ $message }}
            </div>
        @enderror

    </div>

    <div class="d-flex justify-content-between mb-4">

        <div class="form-check">

            <input
                class="form-check-input"
                type="checkbox"
                name="remember"
                id="remember">

            <label class="form-check-label" for="remember">

                Remember Me

            </label>

        </div>

        @if (Route::has('password.request'))

        <a href="{{ route('password.request') }}">

            Forgot Password?

        </a>

        @endif

    </div>

    <button class="btn btn-primary w-100">

        Login

    </button>

</form>

@if (Route::has('register'))

<div class="text-center mt-4">

    Don't have an account?

    <a href="{{ route('register') }}">

        Register

    </a>

</div>

@endif

<script>

function togglePassword(){

    let input=document.getElementById('password');

    input.type=input.type==="password"
        ?"text"
        :"password";

}

</script>

@endsection