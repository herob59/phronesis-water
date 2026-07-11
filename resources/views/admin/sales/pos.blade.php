@extends('layouts.admin')

@section('content')
    <div class="container-fluid px-4 mt-4">

        <!-- PAGE HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h2 class="fw-bold mb-0">Point Of Sale (POS)</h2>
                <small class="text-muted">
                    Fast sales processing and inventory management
                </small>
            </div>

            <div>
                
                    <a href="{{ route('sales.create') }}" class="btn btn-success shadow-sm">
                        <i class="fa fa-receipt"></i>
                        New Order
                    </a>
                
            </div>

        </div>


        <div class="row">

            <!-- LEFT SIDE PRODUCTS -->
            <div class="col-lg-8">

                <!-- SEARCH -->
                <div class="card shadow border-0 rounded-4 mb-4">

                    <div class="card-body">

                        <div class="row align-items-center">

                            <div class="col-md-8">
                                <input type="text" class="form-control form-control-lg" placeholder="Search products...">
                            </div>

                            <div class="col-md-4">
                                <select class="form-control form-control-lg">
                                    <option>All Categories</option>
                                    <option>Water</option>
                                    <option>Drinks</option>
                                    <option>Snacks</option>
                                </select>
                            </div>

                        </div>

                    </div>
                </div>


                <!-- PRODUCT GRID -->
                <div class="row g-4">

                    @foreach ($products as $product)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                            <div class="card border-0 shadow-lg rounded-4 product-card h-100">

                                <div class="product-image-wrapper">

                                    @if ($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="card-img-top product-image">
                                    @else
                                        <img src="https://via.placeholder.com/300x200" class="card-img-top product-image">
                                    @endif

                                </div>

                                <div class="card-body text-center">

                                    <h6 class="fw-bold mb-1 small">
                                        {{ $product->name }}
                                    </h6>

                                    <p class="text-muted small mb-2">
                                        {{ $product->size }}
                                    </p>

                                    <h5 class="text-primary fw-bold mb-2">
                                        ₦{{ number_format($product->price) }}
                                    </h5>

                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">

                                        @csrf

                                        <button class="btn btn-primary btn-sm w-100">
                                            <i class="fa fa-cart-plus"></i>
                                            Add to Cart
                                        </button>

                                    </form>
                                </div>

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>


            <!-- RIGHT SIDE CART -->
            <div class="col-lg-4">

                <div class="card border-0 shadow-lg rounded-4 sticky-top" style="top:20px;">

                    <div class="card-header bg-primary text-white rounded-top-4 py-3">
                        <h5 class="mb-0 fw-bold">
                            <i class="fa fa-shopping-cart"></i>
                            Cart Summary
                        </h5>
                    </div>


                    <div class="card-body cart-body">

                        <!-- CART ITEM -->
                        @php
                            $cart = session('cart', []);
                            $total = 0;
                        @endphp

                        @forelse($cart as $id => $item)
                            <div class="border-bottom py-3">

                                <h6>{{ $item['name'] }}</h6>

                                <div class="d-flex justify-content-between align-items-center">

                                    <div class="d-flex align-items-center">

                                        <form action="{{ route('cart.decrease', $id) }}" method="POST" class="me-2">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">-</button>
                                        </form>

                                        <span>{{ $item['quantity'] }}</span>

                                        <form action="{{ route('cart.increase', $id) }}" method="POST" class="ms-2">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">+</button>
                                        </form>

                                    </div>

                                    <strong>
                                        ₦{{ number_format($item['price'] * $item['quantity']) }}
                                    </strong>

                                </div>

                            </div>

                            @php
                                $total += $item['price'] * $item['quantity'];
                            @endphp

                        @empty

                            <p class="text-center text-muted">
                                Cart is empty
                            </p>
                        @endforelse

                        <hr>

                        <div class="d-flex justify-content-between">
                            <strong>Total</strong>
                            <strong>₦{{ number_format($total) }}</strong>
                        </div>
                        <!-- PAYMENT -->


                        <form action="{{ route('sales.store') }}" method="POST">

                            @csrf

                            <div class="mb-3">
                                <label class="fw-bold mb-2">Payment Method</label>

                                <select name="payment_method" class="form-control">
                                    <option value="Cash">Cash</option>
                                    <option value="Transfer">Transfer</option>
                                    <option value="POS">POS</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="fw-bold mb-2">Customer Name</label>

                                <input type="text" name="customer_name" class="form-control"
                                    placeholder="Optional customer name">
                            </div>

                            <div class="d-grid gap-3">

                                <button type="submit" class="btn btn-success btn-lg rounded-pill shadow-sm">

                                    <i class="fa fa-check-circle"></i>
                                    Complete Sale

                                </button>

                            </div>

                        </form>


                    </div>

                </div>

            </div>

        </div>


        <!-- RECENT TRANSACTIONS -->
        <div class="card border-0 shadow-lg rounded-4 mt-5">

            <div class="card-header bg-white py-3 border-0">
                <h5 class="fw-bold mb-0">
                    Recent Transactions
                </h5>
            </div>

            <div class="card-body table-responsive">

                <table class="table table-hover align-middle">

                    <thead>
                        <tr>
                            <th>Invoice</th>
                            <th>Customer</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($recentSales as $sale)
                            <tr>

                                <td>
                                    #INV-{{ $sale->id }}
                                </td>

                                <td>
                                    {{ $sale->customer->name ?? 'Walk-in' }}
                                </td>

                                <td>
                                    ₦{{ number_format($sale->total) }}
                                </td>

                                <td>
                                    <span class="badge bg-success rounded-pill">
                                        Paid
                                    </span>
                                </td>

                                <td>
                                    {{ $sale->created_at->format('d M Y') }}
                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>
    <style>
        .product-image {
            height: 120px;
            object-fit: cover;
        }

        .product-card .card-body {
            padding: 10px;
        }

        .product-card h6 {
            font-size: 12px;
        }

        .product-card p {
            font-size: 10px;
            margin-bottom: 5px;
        }
    </style>
@endsection
