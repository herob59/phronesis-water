@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Add Sale
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('sales.store') }}"
                  method="POST">

                @csrf

                <!-- PRODUCT -->
                <div class="mb-3">

                    <label>Product</label>

                    <select name="product_id"
                            class="form-control"
                            required>

                        <option value="">
                            Select Product
                        </option>

                        @foreach($products as $product)

                            <option value="{{ $product->id }}">

                                {{ $product->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- QUANTITY -->
                <div class="mb-3">

                    <label>Quantity</label>

                    <input type="number"
                           name="quantity"
                           class="form-control"
                           required>

                </div>

                <!-- TOTAL -->
                <div class="mb-3">

                    <label>Total Amount</label>

                    <input type="number"
                           step="0.01"
                           name="total"
                           class="form-control"
                           required>

                </div>

                <button class="btn btn-primary">
                    Save Sale
                </button>

            </form>

        </div>

    </div>

</div>

@endsection