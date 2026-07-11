@extends('layouts.admin')

@section('title', 'Daily Report')

@section('content')

   <div class="container-fluid px-4">
<link rel="stylesheet" href="{{ asset('css/report.css') }}">
        <!-- Page Header -->
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-center mt-4 mb-4">

            <div>
                <h2 class="fw-bold mb-1">
                    <i class="fa-solid fa-calendar-day text-primary me-2"></i>
                    Daily Report
                </h2>

                <p class="text-muted mb-2">
                    View today's production, sales, expenses and business performance.
                </p>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                        </li>

                        <li class="breadcrumb-item">
                            <a href="{{ route('reports.index') }}">Reports</a>
                        </li>

                        <li class="breadcrumb-item active">
                            Daily Report
                        </li>
                    </ol>
                </nav>

            </div>

            <div class="mt-3 mt-lg-0">

                <span class="badge bg-primary fs-6 px-3 py-2 me-2">
                    <i class="fa-solid fa-calendar"></i>
                    {{ now()->format('l, d M Y') }}
                </span>

                <button onclick="window.print()" class="btn btn-outline-dark shadow-sm">
                    <i class="fa fa-print"></i>
                    Print
                </button>

                {{-- <a href="{{ route('reports.daily.pdf') }}" class="btn btn-danger">
                        Export PDF
                    </a> --}}

            </div>

        </div>
        <!-- ============================= -->
<!-- REPORT SUMMARY CARDS -->
<!-- ============================= -->

<div class="row g-4 mb-4">

    <!-- Today's Sales -->
    <div class="col-xl-3 col-md-6">
      <div class="summary-card sales-card h-100">
           
                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <small class="text-uppercase">Today's Sales</small>

                        <h2 class="fw-bold mt-2">
                            ₦{{ number_format($sales,2) }}
                        </h2>
                    </div>

                    <div>
                        <i class="fa-solid fa-money-bill-wave fa-3x opacity-75"></i>
                    </div>

                </div>
        </div>
    </div>

    <!-- Production -->

   <div class="col-xl-3 col-md-6">

    <div class="summary-card production-card h-100">

        <div class="d-flex justify-content-between align-items-center">

            <div>

                <small class="text-uppercase">
                    Production
                </small>

                <h2 class="fw-bold mt-2">
                    {{ number_format($production) }}
                </h2>

            </div>

            <div>

                <i class="fa-solid fa-industry"></i>

            </div>

        </div>

    </div>

</div>

    <!-- Expenses -->

    <div class="col-xl-3 col-md-6">

       <div class="summary-card expense-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase">
                            Expenses
                        </small>

                        <h2 class="fw-bold mt-2">
                            ₦{{ number_format($expenses,2) }}
                        </h2>

                    </div>

                    <div>

                        <i class="fa-solid fa-wallet fa-3x opacity-75"></i>

                    </div>

                </div>
        </div>

    </div>

    <!-- Profit -->

    <div class="col-xl-3 col-md-6">

       <div class="summary-card profit-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <small class="text-uppercase">
                            Profit
                        </small>

                        <h2 class="fw-bold mt-2">
                            ₦{{ number_format($profit,2) }}
                        </h2>

                    </div>

                    <div>

                        <i class="fa-solid fa-chart-line fa-3x opacity-75"></i>

                    </div>

                </div>

        </div>

    </div>

    <!-- Orders -->

    <div class="col-xl-4 col-md-6">

<div class="summary-card order-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="text-muted">
                            Orders Today
                        </h6>

                        <h2 class="fw-bold">
                            {{ $orders }}
                        </h2>

                    </div>

                    <div>

                        <i class="fa-solid fa-cart-shopping fa-2x text-primary"></i>

                    </div>

                </div>

        </div>

    </div>

    <!-- Available Stock -->

    <div class="col-xl-4 col-md-6">

    <div class="summary-card stock-card h-100">

                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="text-muted">
                            Available Stock
                        </h6>

                        <h2 class="fw-bold">
                            {{ number_format($stock) }}
                        </h2>

                    </div>

                    <div>

                        <i class="fa-solid fa-boxes-stacked fa-2x text-success"></i>

                    </div>

                </div>

        </div>

    </div>

    <!-- Low Stock -->

    <div class="col-xl-4 col-md-6">

      <div class="summary-card lowstock-card h-100">


                <div class="d-flex justify-content-between align-items-center">

                    <div>

                        <h6 class="text-muted">
                            Low Stock Products
                        </h6>

                        <h2 class="fw-bold text-danger">
                            {{ $lowStock }}
                        </h2>

                    </div>

                    <div>

                        <i class="fa-solid fa-triangle-exclamation fa-2x text-danger"></i>

                    </div>

                </div>

        </div>

    </div>

</div>

<!-- LOW STOCK ALERT -->

@if($lowStock > 0)

<div class="alert alert-warning border-0 shadow rounded-4">

    <div class="d-flex align-items-center">

        <i class="fa-solid fa-triangle-exclamation fa-2x me-3"></i>

        <div>

            <strong>Attention!</strong>

            There are

            <strong>{{ $lowStock }}</strong>

            product(s) below the reorder level.

            Please restock immediately.

        </div>

    </div>

</div>

@endif
<!-- ====================================== -->
<!-- RECENT SALES REPORT -->
<!-- ====================================== -->

<div class="card border-0 shadow rounded-4 mb-4">

    <div class="card-header bg-white border-0">

        <div class="d-flex justify-content-between align-items-center">

            <h5 class="fw-bold mb-0">
                <i class="fa-solid fa-cart-shopping text-primary me-2"></i>
                Today's Sales Transactions
            </h5>

            <span class="badge bg-primary">
                {{ $recentSales->total() }} Sales
            </span>

        </div>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>#</th>

                        <th>Invoice</th>

                        <th>Product</th>

                        <th>Quantity</th>

                        <th>Unit Price</th>

                        <th>Total</th>

                        <th>Time</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($recentSales as $sale)

                        <tr>

                            <td>
                                {{ $loop->iteration }}
                            </td>

                            <td>

                                <span class="fw-bold text-primary">
                                    INV-{{ str_pad($sale->id,5,'0',STR_PAD_LEFT) }}
                                </span>

                            </td>

                            <td>

                                {{ $sale->product->name ?? 'N/A' }}

                            </td>

                            <td>

                                <span class="badge bg-info">

                                    {{ $sale->quantity }}

                                </span>

                            </td>

                            <td>

                                ₦{{ number_format($sale->product->price ?? 0,2) }}

                            </td>

                            <td>

                                <strong>

                                    ₦{{ number_format($sale->total,2) }}

                                </strong>

                            </td>

                            <td>

                                {{ $sale->created_at->format('h:i A') }}

                            </td>

                            <td>

                                <span class="badge bg-success">

                                    Completed

                                </span>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="text-center py-5">

                                <i class="fa-solid fa-receipt fa-3x text-muted mb-3"></i>

                                <h5>No Sales Today</h5>

                                <p class="text-muted">

                                    There are no sales transactions recorded today.

                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    <div class="card-footer bg-white">

        {{ $recentSales->links() }}

    </div>

</div>

<!-- ================================= -->
<!-- DAILY PERFORMANCE DASHBOARD -->
<!-- ================================= -->

<div class="row g-4 mb-4">

    <!-- Sales Chart -->
    <div class="col-lg-8">

        <div class="card border-0 shadow rounded-4 h-100">

            <div class="card-header bg-white border-0">

                <h5 class="fw-bold mb-0">
                    <i class="fa-solid fa-chart-line text-primary me-2"></i>
                    Daily Sales Performance
                </h5>

            </div>

            <div class="card-body">

                <canvas id="dailySalesChart" height="110"></canvas>

            </div>

        </div>

    </div>

    <!-- Best Seller -->
    <div class="col-lg-4">

        <div class="card border-0 shadow rounded-4 h-100">

            <div class="card-header bg-white border-0">

                <h5 class="fw-bold mb-0">
                    <i class="fa-solid fa-trophy text-warning me-2"></i>
                    Best Selling Product
                </h5>

            </div>

            <div class="card-body">

                @if($bestSeller)

                    <div class="text-center">

                        <i class="fa-solid fa-award fa-4x text-warning mb-3"></i>

                        <h4 class="fw-bold">

                            {{ $bestSeller->product->name }}

                        </h4>

                        <p class="text-muted">

                            Quantity Sold Today

                        </p>

                        <span class="badge bg-success fs-5">

                            {{ $bestSeller->total_qty }}

                        </span>

                    </div>

                @else

                    <div class="text-center text-muted py-5">

                        <i class="fa-solid fa-box-open fa-3x mb-3"></i>

                        <p>No sales recorded today.</p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

<!-- ================================= -->
<!-- LOW STOCK PRODUCTS -->
<!-- ================================= -->

<div class="card border-0 shadow rounded-4">

    <div class="card-header bg-white border-0">

        <h5 class="fw-bold mb-0">

            <i class="fa-solid fa-triangle-exclamation text-danger me-2"></i>

            Low Stock Products

        </h5>

    </div>

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th>Product</th>

                        <th>Available</th>

                        <th>Reorder Level</th>

                        <th>Status</th>

                    </tr>

                </thead>

                <tbody>

                @forelse($lowStockProducts as $stock)

                    <tr>

                        <td>

                            {{ $stock->product->name }}

                        </td>

                        <td>

                            {{ $stock->quantity }}

                        </td>

                        <td>

                            {{ $stock->reorder_level }}

                        </td>

                        <td>

                            @if($stock->quantity == 0)

                                <span class="badge bg-danger">

                                    Out of Stock

                                </span>

                            @else

                                <span class="badge bg-warning text-dark">

                                    Low Stock

                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="4" class="text-center py-4">

                            <i class="fa-solid fa-circle-check text-success fa-2x mb-2"></i>

                            <p class="mb-0">

                                All products have sufficient stock.

                            </p>

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>
<div class="card border-0 shadow rounded-4">
    <div class="card-header bg-white">
        <h5 class="fw-bold">
            Daily Business Performance
        </h5>
    </div>

    <div class="card-body">
        <canvas id="dailyChart" height="110"></canvas>
    </div>
</div>
</div>
<div class="card border-0 shadow rounded-4 mt-4">
    <div class="card-header bg-white">
        <h5 class="fw-bold">
            Financial Distribution
        </h5>
    </div>

    <div class="card-body">
        <canvas id="financeChart"></canvas>
    </div>
    
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const ctx = document.getElementById('dailySalesChart');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: [

            'Sales',

            'Production',

            'Expenses',

            'Profit'

        ],

        datasets: [{

            label: 'Today',

            data: [

                {{ $sales }},

                {{ $production }},

                {{ $expenses }},

                {{ $profit }}

            ],

            backgroundColor: [

                '#0d6efd',

                '#198754',

                '#dc3545',

                '#0dcaf0'

            ],

            borderRadius: 10

        }]

    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        },

        scales: {

            y: {

                beginAtZero: true

            }

        }

    }

});

</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

const finance = document.getElementById('financeChart');

if(finance){

new Chart(finance,{

    type:'doughnut',

    data:{

        labels:[

            'Sales',

            'Expenses',

            'Profit'

        ],

        datasets:[{

            data:[

                {{ $sales }},

                {{ $expenses }},

                {{ $profit }}

            ],

            backgroundColor:[

                '#0d6efd',

                '#dc3545',

                '#198754'

            ]

        }]

    },

    options:{

        responsive:true

    }

});

}

</script>
@endsection
