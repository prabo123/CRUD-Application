<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage; // Import Storage for file handling

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index() {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create() {
        return view('products.create');
    }

    /**
     * Store a newly created product in the database.
     */
    public function store(Request $request) {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'qty'         => 'required|numeric|min:1',
            'price'       => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable|string|max:255',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif|max:2048' // Validate Image
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        Product::create($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form for editing a product.
     */
    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    /**
     * Update a product.
     */
    public function update(Request $request, Product $product) {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'qty'         => 'required|numeric|min:1',
            'price'       => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable|string|max:255',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Optional Image
        ]);

        // Handle Image Upload & Delete Old One
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            // Upload new image
            $imagePath = $request->file('image')->store('product_images', 'public');
            $data['image'] = $imagePath;
        }

        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the product from storage.
     */
    public function destroy(Product $product) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }
}


