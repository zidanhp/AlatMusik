<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('dashboard.products', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/products');
            $validated['image_path'] = Storage::url($path);
        }

        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image_path) {
                $oldImage = str_replace('/storage', 'public', $product->image_path);
                Storage::delete($oldImage);
            }

            $path = $request->file('image')->store('public/products');
            $validated['image_path'] = Storage::url($path);
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        if ($product->image_path) {
            $oldImage = str_replace('/storage', 'public', $product->image_path);
            Storage::delete($oldImage);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus');
    }
}