@extends('layouts.admin')

@section('content')
    <div class="container">
        <h2>Add Product</h2>

        <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
            @csrf

            <input type="text" name="name" placeholder="Product Name" class="form-control mb-2">

            <input type="text" name="size" placeholder="Size" class="form-control mb-2">

            <input type="text" name="category" placeholder="Category" class="form-control mb-2">

            <input type="number" name="price" placeholder="Price" class="form-control mb-2">

            <input type="file" name="image" class="form-control mb-2">

            <button class="btn btn-primary">Save</button>
        </form>
    </div>
    
    Description
    <textarea name="description"></textarea>

    Stock
    <input type="number" name="stock">

    Reorder Level
    <input type="number" name="reorder_level">

    Status
    <select name="status">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>
@endsection
