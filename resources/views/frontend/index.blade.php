@extends('layouts.frontend')

@section('content')
    <!-- HERO SECTION -->

    <section class="hero position-relative">

        <img src="{{ asset('assets/images/humanbottlewater.jpg') }}" class="w-100" style="height: 650px; object-fit: cover;">

        <div class="hero-overlay"></div>
        <div class="position-absolute top-50 start-50 translate-middle text-center text-white">

            <h1 class="display-3 fw-bold">
                Pure & Refreshing Water
            </h1>

            <p class="lead">
                Healthy, Safe and Affordable Drinking Water
                for Homes, Offices and Events.
            </p>

            <a href="#products" class="btn btn-primary btn-lg me-2">
                Order Now
            </a>

            <a href="#about" class="btn btn-outline-light btn-lg">
                Learn More
            </a>

        </div>


    </section>


    <section class="py-5 bg-white">

        <div class="container">

            <div class="row text-center g-4">


                <div class="col-md-3">

                    <h2 class="fw-bold text-primary">
                        10+
                    </h2>

                    <p class="text-muted">
                        Years Experience
                    </p>

                </div>


                <div class="col-md-3">

                    <h2 class="fw-bold text-primary">
                        50K+
                    </h2>

                    <p class="text-muted">
                        Happy Customers
                    </p>

                </div>



                <div class="col-md-3">

                    <h2 class="fw-bold text-primary">
                        500+
                    </h2>

                    <p class="text-muted">
                        Monthly Deliveries
                    </p>

                </div>



                <div class="col-md-3">

                    <h2 class="fw-bold text-primary">
                        100%
                    </h2>

                    <p class="text-muted">
                        Quality Assurance
                    </p>

                </div>


            </div>

        </div>

    </section>
    <!-- FEATURES -->

    <section class="py-5 bg-light">

        <div class="container">

            <div class="row text-center">

                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow-sm p-4 h-100">

                        <i class="fa-solid fa-droplet fa-3x text-primary mb-3"></i>

                        <h4>100% Pure Water</h4>

                        <p>
                            Processed with modern purification technology.
                        </p>

                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow-sm p-4 h-100">



                        <i class="fas fa-truck fa-3x text-success mb-3"></i>

                        <h4>Fast Delivery</h4>

                        <p>
                            We deliver directly to homes and businesses.
                        </p>


                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card feature-card border-0 shadow-sm p-4 h-100">


                        <i class="fas fa-award fa-3x text-warning mb-3"></i>

                        <h4>Quality Assured</h4>

                        <p>
                            Produced under strict hygiene standards.
                        </p>


                    </div>


                </div>

            </div>

        </div>

    </section>

    <!-- ABOUT -->

    <section id="about" class="py-5">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <img src="{{ asset('assets/images/humanbottlewater.jpg') }}" class="img-fluid rounded shadow">

                </div>

                <div class="col-lg-6">

                    <h2 class="fw-bold mb-4">
                        About PHRONESIS WATER
                    </h2>

                    <p>
                        <b><mark>PHRONESIS WATER</mark></b> is committed to providing
                        clean, healthy and refreshing drinking water
                        to individuals, families and businesses.
                    </p>

                    <p>
                        Our production process follows modern quality
                        standards to ensure every bottle and sachet
                        meets customer expectations.
                    </p>

                </div>

            </div>

        </div>


    </section>

    <!-- PRODUCTS -->

    <section id="products" class="py-5 bg-light">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Our Products
                </h2>

                <p class="text-muted">
                    Quality water products for every need.
                </p>

            </div>


            <div class="row g-4 justify-content-center">


                <!-- Sachet Water -->

                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6">

                        <div class="card product-card h-100 border-0 shadow-sm">

                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top product-image"
                             class="product-image"
                                alt="{{ $product->name }}">

                            <div class="card-body">

                                <span class="badge bg-primary mb-2">
                                    {{ $product->category }}
                                </span>

                                <h4 class="fw-bold">
                                    {{ $product->name }}
                                </h4>

                                <p class="text-muted">
                                    {{ $product->size }}
                                </p>

                                <h5 class="text-primary fw-bold">
                                    ₦{{ number_format($product->price, 2) }}
                                </h5>

                                <a href="{{ route('products.show', $product) }}"
                                    class="btn btn-outline-primary rounded-pill mt-3">

                                    View Details

                                </a>

                            </div>

                        </div>

                    </div>
                @endforeach
            
            </div>

        </div>

    </section>


    <section class="py-5">

        <div class="container">

            <div class="text-center mb-5">

                <h2 class="fw-bold">
                    Our Production Process
                </h2>

            </div>


            <div class="row text-center g-4">


                <div class="col-md-3 stat-box fade-up">

                    <i class="fas fa-water fa-3x text-primary"></i>

                    <h5 class="mt-3">
                        Water Treatment
                    </h5>

                </div>


                <div class="col-md-3 stat-box fade-up">

                    <i class="fas fa-filter fa-3x text-success"></i>

                    <h5 class="mt-3">
                        Advanced Filtration
                    </h5>

                </div>


                <div class="col-md-3 stat-box fade-up">

                    <i class="fas fa-vial fa-3x text-warning"></i>

                    <h5 class="mt-3">
                        Quality Testing
                    </h5>

                </div>


                <div class="col-md-3 stat-box fade-up">

                    <i class="fas fa-box fa-3x text-danger"></i>

                    <h5 class="mt-3">
                        Safe Packaging
                    </h5>

                </div>


            </div>


        </div>

    </section>

    <section class="py-5 bg-light">

        <div class="container">


            <h2 class="text-center fw-bold mb-5">
                Our Services
            </h2>


            <div class="row g-4">


                <div class="col-md-4">

                    <div class="card service-card fade-up h-100 border-0 shadow-sm p-4 text-center">


                        <i class="fas fa-truck fa-3x text-primary"></i>

                        <h4 class="mt-3">
                            Home Delivery
                        </h4>

                        <p>
                            Fast water delivery to homes and offices.
                        </p>


                    </div>

                </div>



                <div class="col-md-4">

                    <div class="card service-card fade-up h-100 border-0 shadow-sm p-4 text-center">

                        <i class="fas fa-building fa-3x text-success"></i>

                        <h4 class="mt-3">
                            Corporate Supply
                        </h4>

                        <p>
                            Reliable supply for companies and institutions.
                        </p>


                    </div>

                </div>



                <div class="col-md-4">

                    <div class="card service-card fade-up h-100 border-0 shadow-sm p-4 text-center">


                        <i class="fas fa-calendar-check fa-3x text-warning"></i>

                        <h4 class="mt-3">
                            Event Supply
                        </h4>

                        <p>
                            Water solutions for events and occasions.
                        </p>


                    </div>

                </div>


            </div>

        </div>

    </section>

    <!-- CONTACT -->

    <section class="py-5 text-white bg-primary">

        <div class="container text-center">

            <h2 class="fw-bold">
                Need Water Supply?
            </h2>

            <p>
                Contact us today for fast delivery and wholesale orders.
            </p>

            <a href="#" class="btn btn-light btn-lg">
                Contact Us
            </a>

        </div>

    </section>
@endsection
