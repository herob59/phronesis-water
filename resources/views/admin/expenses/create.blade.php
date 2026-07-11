@extends('layouts.admin')

@section('content')

<div class="container-fluid">

    <h2 class="mb-4">
        Add Expense
    </h2>

    <div class="card shadow">

        <div class="card-body">

            <form action="{{ route('expenses.store') }}"
                  method="POST">

                @csrf

                <div class="mb-3">

                    <label>Title</label>

                    <input type="text"
                           name="title"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Category</label>

                    <input type="text"
                           name="category"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Amount</label>

                    <input type="number"
                           step="0.01"
                           name="amount"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Date</label>

                    <input type="date"
                           name="expense_date"
                           class="form-control">

                </div>

                <div class="mb-3">

                    <label>Description</label>

                    <textarea name="description"
                              class="form-control"></textarea>

                </div>

                <button class="btn btn-primary">
                    Save Expense
                </button>

            </form>

        </div>

    </div>

</div>

@endsection