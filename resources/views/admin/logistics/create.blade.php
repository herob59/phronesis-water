@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Add Logistic
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('logistics.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">
                    <label>Driver</label>

                    <input type="text"
                           name="driver"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Vehicle</label>

                    <input type="text"
                           name="vehicle"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Destination</label>

                    <input type="text"
                           name="destination"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Delivery Date</label>

                    <input type="date"
                           name="delivery_date"
                           class="form-control">
                </div>

                <button class="btn btn-primary">
                    Save
                </button>

            </form>

        </div>

    </div>

</div>

@endsection