<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::latest()->paginate(10);

        $totalExpenses = Expense::sum('amount');

        return view(
            'admin.expenses.index',
            compact('expenses', 'totalExpenses')
        );
    }

    public function create()
    {
        return view('admin.expenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'title' => 'required',

            'amount' => 'required|numeric',

            'category' => 'required',

            'expense_date' => 'required|date',

        ]);

        Expense::create($request->all());

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Expense added successfully');
    }
}