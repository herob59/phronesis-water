@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Logistics</li>
</ol>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <h2>Logistics Management</h2>

        <a href="{{ route('logistics.create') }}"
           class="btn btn-primary">

            Add Delivery

        </a>

    </div>

    <div class="card shadow">

        <div class="card-body p-0">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Driver</th>
                        <th>Vehicle</th>
                        <th>Destination</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($logistics as $logistic)

                    <tr>

                        <td>{{ $logistic->driver }}</td>

                        <td>{{ $logistic->vehicle }}</td>

                        <td>{{ $logistic->destination }}</td>

                        <td>
                            {{ $logistic->delivery_date }}
                        </td>

                        <td>

                            <span class="badge bg-primary">
                                {{ $logistic->status }}
                            </span>

                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="5" class="text-center">
                            No logistics found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection