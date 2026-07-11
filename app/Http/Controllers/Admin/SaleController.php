<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Sale;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with([
            'product',
            'customer'
        ])
            ->latest()
            ->paginate(10);

        return view(
            'admin.sales.index',
            compact('sales')
        );
    }

    public function create()
    {
        $products = Product::all();

        $recentSales = Sale::latest()
            ->take(10)
            ->get();

        return view(
            'admin.sales.pos',
            compact('products', 'recentSales')
        );
    }


    public function store(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        $saleIds = []; // ADD THIS

        foreach ($cart as $productId => $item) {

            $sale = Sale::create([
                'product_id' => $productId,
                'quantity'   => $item['quantity'],
                'total'      => $item['price'] * $item['quantity'],
                'date'       => now()->toDateString(),
            ]);

            $saleIds[] = $sale->id;

            Stock::where('product_id', $productId)
                ->decrement('quantity', $item['quantity']);
        }

        session()->put('invoice_sales', $saleIds);

        session()->forget('cart'); // clear cart after sale

        return redirect()->route('sales.invoice');
    }


    public function addToCart(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return back();
    }

    public function increaseQty($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return back()->with('error', 'Item not found in cart.');
        }

        $cart[$id]['quantity'] = ($cart[$id]['quantity'] ?? 0) + 1;

        session()->put('cart', $cart);

        return back()->with('success', 'Quantity updated successfully.');
    }

    public function decreaseQty($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']--;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return back();
    }
    public function history(Request $request)
    {
        $sales = Sale::with('product')
            ->when($request->date, function ($query) use ($request) {
                $query->whereDate('created_at', $request->date);
            })
            ->latest()
            ->paginate(20);

        return view('admin.sales.history', compact('sales'));
    }

    public function invoice()
    {
        $saleIds = session('invoice_sales', []);

        $sales = Sale::with('product')
            ->whereIn('id', $saleIds)
            ->get();

        return view(
            'admin.sales.invoice',
            compact('sales')
        );
    }

    public function show($id)
    {
        return redirect()->route('admin.sales.invoice');
    }
}
