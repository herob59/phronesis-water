@extends('layouts.admin')

@section('content')

<div class="container">

    <h2>Add Production</h2>

    <form method="POST" action="{{ route('production.store') }}">
        @csrf

        <div class="mb-3">
            <label>Product</label>

            <select name="product_id" class="form-control">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Quantity Produced</label>

            <input type="number"
                   name="quantity"
                   class="form-control"
                   required>
        </div>

        <button class="btn btn-primary">
            Save Production
        </button>

    </form>
</div>

@endsection