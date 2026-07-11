<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Logistic;

class LogisticController extends Controller
{
    public function index()
    {
        $logistics = Logistic::latest()->paginate(10);

        return view(
            'admin.logistics.index',
            compact('logistics')
        );
    }

    public function create()
    {
        return view('admin.logistics.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver' => 'required',
            'vehicle' => 'required',
            'destination' => 'required',
            'delivery_date' => 'required|date',
        ]);

        Logistic::create($request->all());

        return redirect()
            ->route('logistics.index')
            ->with('success', 'Logistic created');
    }
}