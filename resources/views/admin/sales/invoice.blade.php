@extends('layouts.admin')

@section('content')
    <div class="container mt-4">

        <div class="card shadow">

            <div class="card-header">
                <h3>Sales Invoice</h3>
            </div>

            <table class="table">

                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @php $grandTotal = 0; @endphp

                    @foreach ($sales as $sale)
                        <tr>
                            <td>{{ $sale->product->name }}</td>
                            <td>{{ $sale->quantity }}</td>
                            <td>₦{{ number_format($sale->total) }}</td>
                        </tr>

                        @php
                            $grandTotal += $sale->total;
                        @endphp
                    @endforeach

                </tbody>

            </table>

            <h3>
                Grand Total:
                ₦{{ number_format($grandTotal) }}
            </h3>
            <p><strong>Date:</strong>
                {{ $sale->created_at->format('d M Y H:i') }}
            </p>

            <button onclick="window.print()"
                    class="btn btn-success">

                Print Invoice

            </button>
        </div>

    </div>
@endsection
