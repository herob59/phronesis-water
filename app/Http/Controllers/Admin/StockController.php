<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::with('product')->get();

        return view('admin.stock.index', compact('stocks'));
    }
}