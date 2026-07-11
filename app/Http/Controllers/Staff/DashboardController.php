<?php

namespace App\Http\Controllers\Staff;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Production;

class DashboardController extends Controller
{
    public function index()
    {
        // Today's sales
        $todaySales = Sale::whereDate('created_at', today())
            ->sum('total');

        // Today's production
        $todayProduction = Production::whereDate('created_at', today())
            ->sum('quantity');

        // Total stock
        $stock = Stock::sum('quantity');

        // Low stock products
        $lowStockProducts = Stock::with('product')
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->get();

        // Recent sales
        $recentSales = Sale::with(['product'])
            ->latest()
            ->take(5)
            ->get();

        // Orders today
        $ordersToday = Sale::whereDate('created_at', today())
            ->count();

        // Product count
        $productsCount = Product::count();

        // Best seller
        $bestSeller = Sale::select(
                'product_id',
                DB::raw('SUM(quantity) as total_qty')
            )
            ->groupBy('product_id')
            ->with('product')
            ->orderByDesc('total_qty')
            ->first();

        // Weekly sales chart
        $salesData = collect([
            (object)['day_name' => 'Monday', 'total' => 25000],
            (object)['day_name' => 'Tuesday', 'total' => 32000],
            (object)['day_name' => 'Wednesday', 'total' => 28000],
            (object)['day_name' => 'Thursday', 'total' =>  70000],
            (object)['day_name' => 'Friday', 'total' => 55000],
            (object)['day_name' => 'Saturday', 'total' => 45000],
            (object)['day_name' => 'Sunday', 'total' => 40000],
        ]);

        return view('staff.dashboard', compact(
            'todaySales',
            'todayProduction',
            'stock',
            'lowStockProducts',
            'recentSales',
            'ordersToday',
            'productsCount',
            'bestSeller',
            'salesData'
        ));
    }
}