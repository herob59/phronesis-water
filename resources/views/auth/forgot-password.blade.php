@extends('layouts.auth')

@section('title', 'Forgot Password')

@section('content')

<div class="text-center mb-4">
    <h2 class="fw-bold">Forgot Password?</h2>

    <p class="text-muted">
        Enter your email address and we'll send you a password reset link.
    </p>
</div>

@if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div class="mb-4">
        <label class="form-label">Email Address</label>

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

    <button class="btn btn-primary w-100">
        Send Password Reset Link
    </button>
</form>

<div class="text-center mt-4">
    <a href="{{ route('login') }}">
        ← Back to Login
    </a>
</div>

@endsection