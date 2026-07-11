<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Sale;

class POSController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();

        $recentSales = Sale::latest()->take(10)->get();

        return view('admin.pos.index', compact(
            'products',
            'recentSales'
        ));
    }
}
