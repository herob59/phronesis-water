<header id="siteHeader" class="site-header">

    <!-- Top Bar -->
    <div class="top-bar">

        <div class="container">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <div class="top-contact">

                    <a href="tel:+234812759681">
                        <i class="fas fa-phone-alt"></i>
                        +234 812 759 681
                    </a>

                    <a href="mailto:info@phronesiswater.com">
                        <i class="fas fa-envelope"></i>
                        info@phronesiswater.com
                    </a>

                </div>

                <div class="top-social">

                    <span>Follow Us</span>

                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>

                </div>

            </div>

        </div>

    </div>

    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg">

        <div class="container">

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">

                <img src="{{ asset('assets/images/phronesis.jpg') }}"
                     alt="Phronesis"
                     height="55">

                <div class="ms-3">

                    <h5 class="mb-0 fw-bold text-primary">PHRONESIS</h5>

                    <small class="text-muted">Water Factory</small>

                </div>

            </a>

            <!-- Toggle -->
            <button class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#mainNavbar">

                <span class="navbar-toggler-icon"></span>

            </button>

            <!-- Menu -->
            <div class="collapse navbar-collapse" id="mainNavbar">

                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('/') ? 'active' : '' }}"
                           href="{{ url('/') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('about') ? 'active' : '' }}"
                           href="{{ url('/about') }}">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('products*') ? 'active' : '' }}"
                           href="{{ url('/products') }}">
                            Products
                        </a>
                    </li>

                     <li class="nav-item">

                    <a class="nav-link" href="#services">Services</a>

                </li>
                <li class="nav-item">

                    <a class="nav-link" href="#gallery">Gallery</a>

                </li>


                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                           href="{{ url('/contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

                <!-- Auth Section -->
                @guest

                    <a href="{{ route('login') }}"
                       class="btn btn-primary rounded-pill px-4">

                        <i class="fas fa-user me-2"></i>

                        Login

                    </a>

                @else

                    <div class="dropdown">

                        <button class="btn btn-outline-primary dropdown-toggle rounded-pill"
                                data-bs-toggle="dropdown">

                            {{ Auth::user()->name }}

                        </button>

                        <ul class="dropdown-menu dropdown-menu-end">

                            <li>
                                <a class="dropdown-item"
                                   href="{{ route('dashboard') }}">
                                    Dashboard
                                </a>
                            </li>

                            <li><hr class="dropdown-divider"></li>

                            <li>

                                <form method="POST"
                                      action="{{ route('logout') }}">

                                    @csrf

                                    <button class="dropdown-item">
                                        Logout
                                    </button>

                                </form>

                            </li>

                        </ul>

                    </div>

                @endguest

            </div>

        </div>

    </nav>

</header>