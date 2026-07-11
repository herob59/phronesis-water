@extends('layouts.admin')

@section('content')
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Products</li>
</ol>
<div class="container">
    <h2>Products</h2>

    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">+ Add Product</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/default.png') }}" width="60">
                </td>
                <td>{{ $product->name }}</td>
                <td>₦{{ number_format($product->price) }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method ('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this product?')">
                            Delete
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>

@endsection