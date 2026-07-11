@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Stock</li>
</ol>

<div class="container-fluid">

    <h2 class="mb-4">Stock Management</h2>

    <div class="card shadow">

        <div class="card-body">

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Reorder Level</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($stocks as $stock)

                    <tr>

                        <td>
                            {{ $stock->product->name ?? 'N/A' }}
                        </td>

                        <td>
                            {{ $stock->quantity }}
                        </td>

                        <td>
                            {{ $stock->reorder_level }}
                        </td>

                        <td>

                            @if($stock->quantity <= $stock->reorder_level)

                                <span class="badge bg-danger">
                                    Low Stock
                                </span>

                            @else

                                <span class="badge bg-success">
                                    In Stock
                                </span>

                            @endif

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No stock found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection