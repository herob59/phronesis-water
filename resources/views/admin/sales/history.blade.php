@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">Sales History</h2>

    <form method="GET">
        <div class="row mb-3">

            <div class="col-md-4">
                <input type="date"
                       name="date"
                       value="{{ request('date') }}"
                       class="form-control">
            </div>

            <div class="col-md-2">
                <button class="btn btn-primary">
                    Filter
                </button>
            </div>

        </div>
    </form>

    <table class="table table-bordered">

        <thead>
            <tr>
                <th>Invoice</th>
                <th>Product</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Date</th>
                <th>Receipt</th>
            </tr>
        </thead>

        <tbody>

            @foreach($sales as $sale)

            <tr>

                <td>#INV-{{ $sale->id }}</td>

                <td>{{ $sale->product->name }}</td>

                <td>{{ $sale->quantity }}</td>

                <td>₦{{ number_format($sale->total) }}</td>

                <td>
                    {{ $sale->created_at->format('d M Y h:i A') }}
                </td>

                <td>

                    <a href="{{ route('sales.invoice', $sale->id) }}"
                       class="btn btn-sm btn-success">

                        Print

                    </a>

                </td>

            </tr>

            @endforeach

        </tbody>

    </table>

    {{ $sales->links() }}

</div>

@endsection