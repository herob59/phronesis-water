@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Sales</li>
</ol>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <h2>Sales Management</h2>

        <a href="{{ route('sales.create') }}"
           class="btn btn-primary">

            Add Sale

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-bordered">

                    <thead>

                        <tr>
                            <th>#</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Date</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($sales as $sale)

                        <tr>

                            <td>{{ $sale->id }}</td>

                            <td>
                                {{ $sale->product->name ?? 'N/A' }}
                            </td>

                            <td>{{ $sale->quantity }}</td>

                            <td>
                                ₦{{ number_format($sale->total) }}
                            </td>

                            <td>
                                {{ $sale->created_at->format('d M Y') }}
                            </td>

                        </tr>

                        @empty

                        <tr>
                            <td colspan="5" class="text-center">
                                No sales found
                            </td>
                        </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

        <div class="card-footer">

            {{ $sales->links() }}

        </div>

    </div>

</div>

@endsection