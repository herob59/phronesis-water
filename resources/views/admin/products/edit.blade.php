@extends('layouts.admin')

@section('content')

<div class="container">
    <h2>Edit Product</h2>

    <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <input type="text" name="name" value="{{ $product->name }}" class="form-control mb-2">

        <input type="text" name="size" value="{{ $product->size }}" class="form-control mb-2">

        <input type="text" name="category" value="{{ $product->category }}" class="form-control mb-2">

        <input type="number" name="price" value="{{ $product->price }}" class="form-control mb-2">

        <input type="file" name="image" class="form-control mb-2">

        <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('images/default.png') }}" width="80">
           <style>
                img { border-radius: 8px; border: 1px solid #ddd; padding: 2px; }
           </style>
                                 <!-- Upload Input -->
            <input type="file" name="image" class="form-control form-control-sm"
                onchange="previewRow(event)">
            <style>input[type="file"] {font-size: 12px;} img { border-radius: 8px;} </style>
            <script>
                function previewImage(event) {
                    let reader = new FileReader();

                    reader.onload = function() {
                        document.getElementById('preview').src = reader.result;
                    }

                    reader.readAsDataURL(event.target.files[0]);
                }
            </script>
        <button class="btn btn-success mt-2">Update</button>
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