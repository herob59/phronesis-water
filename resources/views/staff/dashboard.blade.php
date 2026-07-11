@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
            <div>
                <h1 class="fw-bold">Staff Dashboard</h1>
                <p class="text-muted mb-0">
                    Monitor sales, production, stock, logistics and system performance.
                </p>
            </div>
        </div>


        <!-- TOP SUMMARY CARDS -->
        <div class="row mt-4 my-4">

            <div class="col-md-4 mb-4">
                <a href="{{ route('sales.create') }}" class="text-decoration-none">
                    <div class="card shadow border-0 rounded-4 text-center p-4">
                        <i class="fa fa-cash-register fa-3x text-success mb-3"></i>
                        <h5>Open POS</h5>
                        <p class="text-muted mb-0">
                            Create a new sale
                        </p>
                    </div>
                </a>
            </div>
          <div class="col-md-4 mb-4">
                <a href="{{ route('sales.index') }}" class="text-decoration-none">
                    <div class="card shadow border-0 rounded-4 text-center p-4">
                        <i class="fa fa-history fa-3x text-primary mb-3"></i>
                        <h5>Sales History</h5>
                        <p class="text-muted mb-0">
                            View all transactions
                        </p>
                    </div>
                </a>
            </div>

            <div class="col-md-4">
                <a href="{{ route('stock.index') }}" class="text-decoration-none">
                    <div class="card shadow border-0 rounded-4 text-center p-4">
                        <i class="fa fa-boxes-stacked fa-3x text-warning mb-3"></i>
                        <h5>Stock Management</h5>
                        <p class="text-muted mb-0">
                            Manage inventory
                        </p>
                    </div>
                </a>
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
        document.addEventListener('DOMContentLoaded', function() {

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
