<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Production;
use App\Models\Stock;

use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;


class ProductionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {

            DB::transaction(function () use ($request) {

                // SAVE PRODUCTION
                Production::create([
                    'product_id' => $request->product_id,
                    'quantity' => $request->quantity,
                ]);

                // UPDATE STOCK
                $stock = Stock::where('product_id', $request->product_id)
                    ->lockForUpdate()
                    ->first();

                if (!$stock) {
                    throw new \Exception('Stock record not found');
                }

                $stock->increment('quantity', $request->quantity);
            });

            return redirect()->route('production.index')
                ->with('success', 'Production added successfully');

        } catch (\Exception $e) {

            return back()->with('error', $e->getMessage());
        }
    }

             
     public function index(Request $request)
    {
        // FILTER QUERY
        $query = Production::with('product');

        // FILTER BY PRODUCT
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // FILTER BY DATE
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        // PAGINATED RESULTS
        $productions = $query->latest()->paginate(10);

        // PRODUCTS FOR FILTER DROPDOWN
        $products = Product::all();

        // TOTAL PRODUCTION
        $totalProduction = $query->sum('quantity');

        // TODAY
        $todayProduction = Production::whereDate('created_at', today())
            ->sum('quantity');

        // MONTHLY TOTAL
        $monthlyProduction = Production::whereMonth(
            'created_at',
            Carbon::now()->month
        )->sum('quantity');

        // WEEKLY CHART
        $weeklyProduction = Production::selectRaw("
                DAYNAME(created_at) as day,
                SUM(quantity) as total
            ")
            ->groupBy('day')
            ->get();

        // TOP PRODUCED PRODUCTS
        $topProducts = Production::select(
                'product_id',
                DB::raw('SUM(quantity) as total_qty')
            )
            ->with('product')
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->get();

        return view('admin.production.index', compact(
            'productions',
            'products',
            'topProducts',
            'totalProduction',
            'todayProduction',
            'monthlyProduction',
            'weeklyProduction'
        ));
    }

        public function create()
    {
        $products = Product::all();

        return view('admin.production.create', compact('products'));
    }

        public function exportPdf(Request $request)
    {
        $query = Production::with('product');

        // FILTER PRODUCT
        if ($request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        // FILTER DATE
        if ($request->start_date && $request->end_date) {

            $query->whereBetween('created_at', [
                $request->start_date,
                $request->end_date
            ]);
        }

        $productions = $query->latest()->get();

        $totalProduction = $productions->sum('quantity');

        $pdf = Pdf::loadView(
            'admin.production.report_pdf',
            compact('productions', 'totalProduction')
        );

        return $pdf->download('production-report.pdf');
    }
}

