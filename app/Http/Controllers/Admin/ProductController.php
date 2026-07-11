<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    

            public function index()
        {
            $products = Product::latest()->paginate(10);
            return view('admin.products.index', compact('products'));
        }

              

        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $imagePath = null;

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('products', 'public');

               
            }

            Product::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'size' => $request->size,
                'category' => $request->category,
                'price' => $request->price,
                'image' => $imagePath,
            ]);

            return redirect()->route('products.index')->with('success', 'Product created');
        }

            public function create()
        {
            return view('admin.products.create');
        }


       public function update(Request $request, $id)
        {
            $product = Product::findOrFail($id);

            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            if ($request->hasFile('image')) {

                if ($product->image && Storage::disk('public')->exists($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $request->file('image')->store('products', 'public');
                $product->image = $imagePath;
            }

            $product->update([
                'name' => $request->name,
                'size' => $request->size,
                'category' => $request->category,
                'price' => $request->price,
                'image' => $product->image,
            ]);

            return redirect()->route('products.index')->with('success', 'Product updated');
        }

            public function destroy($id)
        {
            $product = Product::findOrFail($id);

            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return back()->with('success', 'Product deleted');
        }
        public function edit($id)
        {
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact('product'));
        }
}