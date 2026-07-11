@extends('layouts.auth')

@section('title', 'Verify Email')

@section('content')

<div class="container">

    <div class="row justify-content-center align-items-center min-vh-100">

        <div class="col-lg-5 col-md-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-body p-5">

                    <!-- Logo -->
                    <div class="text-center mb-4">

                        <img src="{{ asset('assets/frontend/images/phronesis.jpg') }}"
                             alt="phronesis"
                             height="70"
                             class="mb-3">

                        <h2 class="fw-bold">
                            Verify Your Email
                        </h2>

                        <p class="text-muted mb-0">
                            Thanks for signing up! Before you begin, please verify your
                            email address by clicking the link we just sent you.
                        </p>

                    </div>

                    {{-- Success Message --}}
                    @if (session('status') == 'verification-link-sent')

                        <div class="alert alert-success">

                            <i class="fas fa-circle-check me-2"></i>

                            A new verification link has been sent to your email address.

                        </div>

                    @endif

                    <!-- Illustration -->
                    <div class="text-center mb-4">

                        <i class="fas fa-envelope-open-text text-primary"
                           style="font-size:70px;"></i>

                    </div>

                    <!-- Resend Verification -->
                    <form method="POST"
                          action="{{ route('verification.send') }}">

                        @csrf

                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-primary btn-lg rounded-pill">

                                <i class="fas fa-paper-plane me-2"></i>

                                Resend Verification Email

                            </button>

                        </div>

                    </form>

                    <hr class="my-4">

                    <!-- Logout -->
                    <form method="POST"
                          action="{{ route('logout') }}">

                        @csrf

                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-outline-secondary rounded-pill">

                                <i class="fas fa-right-from-bracket me-2"></i>

                                Log Out

                            </button>

                        </div>

                    </form>

                    <div class="text-center mt-4">

                        <small class="text-muted">

                            Didn't receive the email?

                            Click the button above to send another verification link.

                        </small>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection