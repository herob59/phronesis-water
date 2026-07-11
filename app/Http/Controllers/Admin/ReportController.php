<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Production;
use App\Models\Sale;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Reports Dashboard
     */
    public function index()
    {
        return view('admin.reports.index');
    }

    /**
     * DAILY REPORT
     */
    public function daily()
    {
        $today = Carbon::today();

        $sales = Sale::whereDate('created_at', $today)->sum('total');

        $production = Production::whereDate('created_at', $today)
            ->sum('quantity');

        $expenses = Expense::whereDate('created_at', $today)
            ->sum('amount');

        $orders = Sale::whereDate('created_at', $today)->count();

        $profit = $sales - $expenses;

        $stock = Stock::sum('quantity');

        $lowStock = Stock::whereColumn(
            'quantity',
            '<=',
            'reorder_level'
        )->count();

        $recentSales = Sale::with('product')
            ->whereDate('created_at', $today)
            ->latest()
            ->paginate(10);
        $bestSeller = Sale::select('product_id', DB::raw('SUM(quantity) as total_qty'))
            ->whereDate('created_at', today())
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->first();

        $lowStockProducts = Stock::with('product')
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->get();

        return view('admin.reports.daily', compact(
            'sales',
            'production',
            'expenses',
            'orders',
            'profit',
            'stock',
            'lowStock',
            'recentSales',
            'bestSeller',
            'lowStockProducts'
        ));
    }

    /**
     * WEEKLY REPORT
     */
    public function weekly()
    {
        $start = Carbon::now()->startOfWeek();

        $end = Carbon::now()->endOfWeek();

        $sales = Sale::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('total');

        $production = Production::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('quantity');

        $expenses = Expense::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('amount');

        $orders = Sale::whereBetween(
            'created_at',
            [$start, $end]
        )->count();

        $profit = $sales - $expenses;

        $weeklySales = Sale::select(
            DB::raw('DATE(created_at) as day'),
            DB::raw('SUM(total) as total_sales')
        )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $recentSales = Sale::with('product')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->paginate(15);

        return view('admin.reports.weekly', compact(
            'sales',
            'production',
            'expenses',
            'orders',
            'profit',
            'weeklySales',
            'recentSales'
        ));
    }

    /**
     * MONTHLY REPORT
     */
    public function monthly()
    {
        $start = Carbon::now()->startOfMonth();

        $end = Carbon::now()->endOfMonth();

        $sales = Sale::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('total');

        $production = Production::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('quantity');

        $expenses = Expense::whereBetween(
            'created_at',
            [$start, $end]
        )->sum('amount');

        $orders = Sale::whereBetween(
            'created_at',
            [$start, $end]
        )->count();

        $profit = $sales - $expenses;

        $monthlySales = Sale::select(
            DB::raw('DATE(created_at) as day'),
            DB::raw('SUM(total) as total_sales')
        )
            ->whereBetween('created_at', [$start, $end])
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        $bestSeller = Sale::select(
            'product_id',
            DB::raw('SUM(quantity) as total_qty')
        )
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->first();

        $recentSales = Sale::with('product')
            ->whereBetween('created_at', [$start, $end])
            ->latest()
            ->paginate(20);

        return view('admin.reports.monthly', compact(
            'sales',
            'production',
            'expenses',
            'orders',
            'profit',
            'monthlySales',
            'bestSeller',
            'recentSales'
        ));
    }

    /**
     * SALES REPORT
     */
    public function sales()
    {
        $sales = Sale::with('product')
            ->latest()
            ->paginate(20);

        return view('admin.reports.sales', compact('sales'));
    }

    /**
     * PRODUCTION REPORT
     */
    public function production()
    {
        $productions = Production::latest()
            ->paginate(20);

        return view(
            'admin.reports.production',
            compact('productions')
        );
    }

    /**
     * STOCK REPORT
     */
    public function stock()
    {
        $stocks = Stock::with('product')
            ->paginate(20);

        return view(
            'admin.reports.stock',
            compact('stocks')
        );
    }

    /**
     * EXPENSE REPORT
     */
    public function expenses()
    {
        $expenses = Expense::latest()
            ->paginate(20);

        return view(
            'admin.reports.expenses',
            compact('expenses')
        );
    }

    /**
     * PROFIT REPORT
     */
    public function profit()
    {
        $sales = Sale::sum('total');

        $expenses = Expense::sum('amount');

        $profit = $sales - $expenses;

        return view(
            'admin.reports.profit',
            compact(
                'sales',
                'expenses',
                'profit'
            )
        );
    }
}
