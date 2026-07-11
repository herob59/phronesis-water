@extends('layouts.admin')

@section('title', 'Report Management')

@section('content')

<div class="container-fluid px-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div>
            <h2 class="fw-bold">
                <i class="fa-solid fa-chart-column text-primary"></i>
                Report Management
            </h2>
            <p class="text-muted mb-0">
                Generate and view production, sales, stock, expense and profit reports.
            </p>
        </div>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">
            <i class="fa fa-arrow-left"></i> Dashboard
        </a>
    </div>

    <!-- Report Cards -->
    <div class="row g-4">

        <!-- Daily -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-calendar-day fa-3x text-primary"></i>
                    </div>

                    <h5 class="fw-bold">
                        Daily Report
                    </h5>

                    <p class="text-muted">
                        View today's production, sales, expenses and profit.
                    </p>

                    <a href="{{ route('reports.daily') }}"
                       class="btn btn-primary rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Weekly -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-calendar-week fa-3x text-success"></i>
                    </div>

                    <h5 class="fw-bold">
                        Weekly Report
                    </h5>

                    <p class="text-muted">
                        View this week's production and sales performance.
                    </p>

                    <a href="{{ route('reports.weekly') }}"
                       class="btn btn-success rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Monthly -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-calendar-days fa-3x text-warning"></i>
                    </div>

                    <h5 class="fw-bold">
                        Monthly Report
                    </h5>

                    <p class="text-muted">
                        View monthly statistics and business performance.
                    </p>

                    <a href="{{ route('reports.monthly') }}"
                       class="btn btn-warning text-white rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Sales -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-cart-shopping fa-3x text-danger"></i>
                    </div>

                    <h5 class="fw-bold">
                        Sales Report
                    </h5>

                    <p class="text-muted">
                        View all sales transactions and summaries.
                    </p>

                    <a href="{{ route('reports.sales') }}"
                       class="btn btn-danger rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Production -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-industry fa-3x text-info"></i>
                    </div>

                    <h5 class="fw-bold">
                        Production Report
                    </h5>

                    <p class="text-muted">
                        View daily production records.
                    </p>

                    <a href="{{ route('reports.production') }}"
                       class="btn btn-info text-white rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Stock -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-boxes-stacked fa-3x text-secondary"></i>
                    </div>

                    <h5 class="fw-bold">
                        Stock Report
                    </h5>

                    <p class="text-muted">
                        View current inventory and stock movement.
                    </p>

                    <a href="{{ route('reports.stock') }}"
                       class="btn btn-secondary rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Expenses -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-wallet fa-3x text-dark"></i>
                    </div>

                    <h5 class="fw-bold">
                        Expense Report
                    </h5>

                    <p class="text-muted">
                        Monitor operational expenses.
                    </p>

                    <a href="{{ route('reports.expenses') }}"
                       class="btn btn-dark rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

        <!-- Profit -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow rounded-4 h-100">
                <div class="card-body text-center">

                    <div class="mb-3">
                        <i class="fa-solid fa-chart-line fa-3x text-success"></i>
                    </div>

                    <h5 class="fw-bold">
                        Profit Report
                    </h5>

                    <p class="text-muted">
                        View business profit and financial summary.
                    </p>

                    <a href="{{ route('reports.profit') }}"
                       class="btn btn-success rounded-pill">
                        View Report
                    </a>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection