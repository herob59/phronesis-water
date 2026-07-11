@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Production</li>
</ol>

<div class="container-fluid">

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2>Production Management</h2>

        <div>
            <a href="{{ route('production.create') }}"
               class="btn btn-primary my-2">
                Add Production
            </a>

            <a href="{{ route('production.pdf', request()->query()) }}"
               class="btn btn-danger">
                Download PDF
            </a>
        </div>

    </div>

    <!-- SUCCESS MESSAGE -->
    @if(session('success'))

        <div class="alert alert-success">
            {{ session('success') }}
        </div>

    @endif


    <!-- SUMMARY CARDS -->
    <div class="row mb-4">

        <div class="col-md-4 mb-4">

            <div class="card bg-primary text-white shadow">
                <div class="card-body text-center">

                    <h5>Today's Production</h5>

                    <h2>{{ $todayProduction }}</h2>

                </div>
            </div>

        </div>

        <div class="col-md-4 mb-4">

            <div class="card bg-success text-white shadow">
                <div class="card-body text-center">

                    <h5>This Month</h5>

                    <h2>{{ $monthlyProduction }}</h2>

                </div>
            </div>

        </div>

        <div class="col-md-4">

            <div class="card bg-dark text-white shadow">
                <div class="card-body text-center">

                    <h5>Total Production</h5>

                    <h2>{{ $totalProduction }}</h2>

                </div>
            </div>

        </div>

    </div>


    <!-- FILTER CARD -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <h5>Filter Reports</h5>
        </div>

        <div class="card-body">

            <form method="GET"
                  action="{{ route('production.index') }}">

                <div class="row">

                    <!-- PRODUCT -->
                    <div class="col-md-4">

                        <label class="mb-1">Product</label>

                        <select name="product_id"
                                class="form-control">

                            <option value="">
                                All Products
                            </option>

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                    {{ request('product_id') == $product->id ? 'selected' : '' }}>

                                    {{ $product->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <!-- START DATE -->
                    <div class="col-md-3">

                        <label class="mb-1">Start Date</label>

                        <input type="date"
                               name="start_date"
                               value="{{ request('start_date') }}"
                               class="form-control">

                    </div>


                    <!-- END DATE -->
                    <div class="col-md-3">

                        <label class="mb-1">End Date</label>

                        <input type="date"
                               name="end_date"
                               value="{{ request('end_date') }}"
                               class="form-control">

                    </div>


                    <!-- FILTER BUTTON -->
                    <div class="col-md-2 d-flex align-items-end">

                        <button class="btn btn-primary w-100">
                            Filter
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>


    <!-- TOP PRODUCTS -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <h5>Top Produced Products</h5>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total Produced</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($topProducts as $item)

                        <tr>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ $item->total_qty }}</td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="2" class="text-center">
                                No data found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    <!-- CHART -->
    <div class="card shadow mb-4">

        <div class="card-header">
            <h5>Weekly Production Analytics</h5>
        </div>

        <div class="card-body">
            <canvas id="productionChart"></canvas>
        </div>

    </div>


    <!-- PRODUCTION TABLE -->
    <div class="card shadow">

        <div class="card-header">
            <h5>Production History</h5>
        </div>

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered mb-0">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($productions as $production)

                        <tr>

                            <td>{{ $production->id }}</td>

                            <td>
                                {{ $production->product->name ?? 'N/A' }}
                            </td>

                            <td>{{ $production->quantity }}</td>

                            <td>
                                {{ $production->created_at->format('d M Y') }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="4" class="text-center">
                                No production records found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer">
            {{ $productions->links() }}
        </div>

    </div>

</div>


<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('productionChart');

    new Chart(ctx, {

        type: 'bar',

        data: {

            labels: {!! json_encode($weeklyProduction->pluck('day')) !!},

            datasets: [{
                label: 'Production Quantity',

                data: {!! json_encode($weeklyProduction->pluck('total')) !!}
            }]
        }
    });

});
</script>

@endsection