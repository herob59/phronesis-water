@extends('layouts.admin')

@section('content')

<div class="container-fluid px-4">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h1 class="fw-bold">Admin Dashboard</h1>
            <p class="text-muted mb-0">
                Monitor sales, production, stock, logistics and system performance.
            </p>
        </div>

        <div>
            <a href="{{ route('products.create') }}" class="btn btn-primary shadow-sm">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>
    </div>


    <!-- TOP SUMMARY CARDS -->
    <div class="row g-4 mb-4">

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 bg-primary text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Today's Production</h6>
                            <h2 class="fw-bold">{{ $production }}</h2>
                        </div>

                        <div class="dashboard-icon">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 bg-success text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Total Sales</h6>
                            <h2 class="fw-bold">₦{{ number_format($totalSales) }}</h2>
                        </div>

                        <div class="dashboard-icon">
                            <i class="fa-solid fa-cart-shopping"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 bg-warning text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Available Stock</h6>
                            <h2 class="fw-bold">{{ number_format($totalStock) }}</h2> 
                        </div>

                        <div class="dashboard-icon">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-lg rounded-4 bg-danger text-white h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase">Low Stock Alerts</h6>
                            <h2 class="fw-bold">{{ $lowStockProducts->count() }}</h2>
                        </div>

                        <div class="dashboard-icon">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <!-- CHART SECTION -->
    <div class="row g-4 mb-4">

        <!-- SALES CHART -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-0">Weekly Sales Analytics</h5>
                </div>

                <div class="card-body">
                    <canvas id="salesChart" height="120"></canvas>
                </div>
            </div>
        </div>


        <!-- QUICK STATS -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-lg rounded-4 h-100">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-0">Quick Statistics</h5>
                </div>

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-4">
                        <span>Orders Today</span>
                        <strong>{{ $ordersToday }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span>Best Seller</span>
                        <strong>{{ $bestSeller->product->name ?? 'N/A' }}</strong>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                        <span>Total Products</span>
                        <strong>{{ $productsCount }}</strong>
                    </div>

                    <div class="d-flex justify-content-between">
                        <span>Low Stock Products</span>
                        <strong>{{ $lowStockProducts->count() }}</strong>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <!-- RECENT SALES + STOCK -->
    <div class="row g-4">

        <!-- RECENT SALES -->
        <div class="col-lg-7">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-header bg-white border-0 pt-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Recent Sales</h5>

                    <a href="{{ route('sales.index') }}" class="btn btn-sm btn-outline-primary">
                        View All
                    </a>
                </div>

                <div class="card-body table-responsive">

                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Product</th>
                                <th>Qty</th>
                                <th>Amount</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($recentSales as $sale)

                            <tr>
                                <td>{{ $sale->customer->name ?? 'Walk-in' }}</td>
                                <td>{{ $sale->product->name ?? 'N/A' }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>
                                    ₦{{ number_format($sale->total) }}
                                </td>
                            </tr>

                            @empty

                            <tr>
                                <td colspan="4" class="text-center text-muted">
                                    No sales found
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>

                </div>
            </div>
        </div>


        <!-- LOW STOCK PRODUCTS -->
        <div class="col-lg-5">

            <div class="card border-0 shadow-lg rounded-4">

                <div class="card-header bg-white border-0 pt-4">
                    <h5 class="fw-bold mb-0 text-danger">
                        Low Stock Alerts
                    </h5>
                </div>

                <div class="card-body">

                    @forelse($lowStockProducts as $item)

                        <div class="d-flex justify-content-between align-items-center border-bottom py-3">

                            <div>
                                <strong>{{ $item->product->name ?? 'N/A' }}</strong>
                                <br>
                                <small class="text-muted">
                                    Reorder Level:
                                    {{ $item->reorder_level }}
                                </small>
                            </div>

                            <span class="badge bg-danger rounded-pill px-3 py-2">
                                {{ $item->quantity }} left
                            </span>

                        </div>

                    @empty

                        <div class="alert alert-success mb-0">
                            No low stock alerts.
                        </div>

                    @endforelse

                </div>
            </div>
        </div>

    </div>

</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const ctx = document.getElementById('salesChart');

        new Chart(ctx, {
            type: 'bar',

            data: {
                labels: {!! json_encode($salesData->pluck('day_name')) !!},

                datasets: [{
                    label: 'Sales',
                    data: {!! json_encode($salesData->pluck('total')) !!},
                    tension: 0.4,
                    fill: true
                }]
            },

            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true
                    }
                }
            }
        });

    });

</script>

@endsection
