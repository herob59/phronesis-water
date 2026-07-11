<div id="layoutSidenav_nav">

    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">

        <!-- BRAND -->
        <div class="sb-sidenav-menu">

            <div class="nav">

                <!-- LOGO -->
                <div class="sidebar-brand text-center py-4">



                    <small class="text-light">
                        Management Portal
                    </small>

                </div>

                <!-- DASHBOARD -->
                @if (auth()->user()->role == 'admin')
                    <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active-menu' : '' }}"
                        href="{{ route('admin.dashboard') }}">

                        <div class="sb-nav-link-icon">
                            <i class="fas fa-gauge-high"></i>
                        </div>

                        Dashboard

                    </a>
                @endif


                <!-- STAFF DASHBOARD -->
                @if (auth()->user()->role == 'staff')
                    <a class="nav-link {{ request()->routeIs('staff.dashboard') ? 'active-menu' : '' }}"
                        href="{{ route('staff.dashboard') }}">

                        <div class="sb-nav-link-icon">
                            <i class="fas fa-house"></i>
                        </div>

                        Staff Dashboard

                    </a>
                @endif


                <!-- PRODUCTS -->
                <a class="nav-link {{ request()->routeIs('products.*') ? 'active-menu' : '' }}"
                    href="{{ route('products.index') }}">

                    <div class="sb-nav-link-icon">
                        <i class="fas fa-box"></i>
                    </div>

                    Products

                </a>





                <!-- SALES -->
                <a class="nav-link {{ request()->routeIs('sales.*') ? 'active-menu' : '' }}"
                    href="{{ route('sales.index') }}">

                    <div class="sb-nav-link-icon">
                        <i class="fas fa-cart-shopping"></i>
                    </div>

                    Sales



                    <!-- STOCK -->
                    <a class="nav-link {{ request()->routeIs('stock.*') ? 'active-menu' : '' }}"
                        href="{{ route('stock.index') }}">

                        <div class="sb-nav-link-icon">
                            <i class="fas fa-warehouse"></i>
                        </div>

                        Stock

                    </a>


                    <!-- ADMIN ONLY -->
                    @if (auth()->user()->role == 'admin')
                        <!-- EXPENSE -->
                        <a class="nav-link {{ request()->routeIs('expenses.*') ? 'active-menu' : '' }}"
                            href="{{ route('expenses.index') }}">

                            <div class="sb-nav-link-icon">
                                <i class="fas fa-money-bill-wave"></i>
                            </div>

                            Expenses

                        </a>

                        <!-- PRODUCTION -->
                        <a class="nav-link {{ request()->routeIs('production.*') ? 'active-menu' : '' }}"
                            href="{{ route('production.index') }}">

                            <div class="sb-nav-link-icon">
                                <i class="fas fa-industry"></i>
                            </div>

                            Production

                        </a>
                        <!-- LOGISTICS -->
                        <a class="nav-link {{ request()->routeIs('logistics.*') ? 'active-menu' : '' }}"
                            href="{{ route('logistics.index') }}">

                            <div class="sb-nav-link-icon">
                                <i class="fas fa-truck"></i>
                            </div>

                            Logistics

                        </a>
                        <!-- REPORTS -->
                        <a class="nav-link {{ request()->routeIs('reports.*') ? 'active-menu' : '' }}"
                            href="{{ route('reports.index') }}">

                            <div class="sb-nav-link-icon">
                                <i class="fa-solid fa-chart-column"></i>
                            </div>

                           Reports

                        </a>

                        <!-- USERS -->
                        <a class="nav-link {{ request()->routeIs('users.*') ? 'active-menu' : '' }}"
                            href="{{ route('users.index') }}">

                            <div class="sb-nav-link-icon">
                                <i class="fas fa-users"></i>
                            </div>

                            Users

                        </a>
                    @endif

            </div>

        </div>

        <!-- FOOTER -->
        <div class="sb-sidenav-footer">

            <div class="small">
                Logged in as:
            </div>

            {{ auth()->user()->name }}

        </div>

    </nav>

</div>
