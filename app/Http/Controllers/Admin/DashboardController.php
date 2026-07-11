<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Production;

class DashboardController extends Controller
{

    public function index(Request $request)
    {

         // ✅ TODAY'S PRODUCTION
    $production = Production::whereDate('created_at', today())->sum('quantity');

     // ✅ TODAY'S sale (AMOUNT)
    $sales = DB::transaction(function () {
    return Sale::whereDate('created_at', today())->get(); // ✅ return here
});

    // ✅ STOCK TOTAL

    $totalStock = Stock::sum('quantity');
        $lowStockProducts = Stock::where('quantity', '<=', 5)->get();

        // ✅ WEEKLY sale DATA (FOR CHART)
   $salesData = Sale::selectRaw("
        DAYNAME(created_at) as day_name,
        DAYOFWEEK(created_at) as day_number,
        SUM(total) as total
    ")
        ->groupBy('day_name', 'day_number')
        ->orderBy('day_number')
        ->get();

     /*   $salesData = collect([
    (object)['day_name' => 'Monday', 'total' => 25000],
    (object)['day_name' => 'Tuesday', 'total' => 32000],
    (object)['day_name' => 'Wednesday', 'total' => 28000],
    (object)['day_name' => 'Thursday', 'total' => 45000],
    (object)['day_name' => 'Friday', 'total' => 55000],
    (object)['day_name' => 'Saturday', 'total' => 70000],
    (object)['day_name' => 'Sunday', 'total' => 40000],
]);*/
       // ✅ WEEKLY sale (for chart)
       // ✅ TODAY sale (NUMBER)
   

    $productsCount = Product::count();

    // ✅ TOTAL sale (ALL TIME)
    $totalSales = Sale::sum('total');

    // ✅ RECENT sale
    $recentSales = Sale::with(['product', 'customer'])
        ->latest()
        ->paginate(5);

    // ✅ STOCK LIST
    $stocks = Stock::with('product')->get();

    // ✅ BEST SELLER
    $bestSeller = Sale::select('product_id', DB::raw('SUM(quantity) as total_qty'))
        ->groupBy('product_id')
        ->orderByDesc('total_qty')
        ->with('product')
        ->first();

    // ✅ ORDERS TODAY
    $ordersToday = Sale::whereDate('created_at', today())->count();

        // ✅ RECENT LOGISTICS (FIX VARIABLE NAME)
        $recentLogistics = DB::table('logistics')
            ->orderBy('created_at', 'desc')
            ->paginate(5);

    return view('admin.dashboard', compact(
        'production',
        'sales',
        'totalSales', // ✅ ADD THIS
        'totalStock',
        'salesData',
        'recentSales',
        'stocks',
        'bestSeller',
        'ordersToday',
        'recentLogistics',
        'lowStockProducts',
        'productsCount'
        ));
    }
}
