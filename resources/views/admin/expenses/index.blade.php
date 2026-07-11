@extends('layouts.admin')

@section('content')

<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Expenses</li>
</ol>

<div class="container-fluid">

    <div class="d-flex justify-content-between mb-4">

        <h2>Expense Management</h2>

        <a href="{{ route('expenses.create') }}"
           class="btn btn-primary">

            Add Expense

        </a>

    </div>

    <div class="card bg-danger text-white mb-4">

        <div class="card-body">

            <h5>Total Expenses</h5>

            <h2>
                ₦{{ number_format($totalExpenses, 2) }}
            </h2>

        </div>

    </div>

    <div class="card shadow">

        <div class="card-body p-0">

            <table class="table table-bordered mb-0">

                <thead>

                    <tr>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>

                </thead>

                <tbody>

                    @forelse($expenses as $expense)

                    <tr>

                        <td>{{ $expense->title }}</td>

                        <td>{{ $expense->category }}</td>

                        <td>
                            ₦{{ number_format($expense->amount, 2) }}
                        </td>

                        <td>
                            {{ $expense->expense_date }}
                        </td>

                    </tr>

                    @empty

                    <tr>
                        <td colspan="4" class="text-center">
                            No expenses found
                        </td>
                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        <div class="card-footer">

            {{ $expenses->links() }}

        </div>

    </div>

</div>

@endsection