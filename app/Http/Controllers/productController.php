<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all(); 
        
        // Debugging: Uncomment to check data
        // dd($products); 
        
        return view('products.index', ['products' => $products]); 
    }

    public function create() {
        return view('products.create'); 
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required|string|max:100', 
            'qty' => 'required|numeric|min:1',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
            'description' => 'nullable|string|max:255'
        ]);

        Product::create($data); 

        return redirect()->route('product.index')->with('success', 'Product created successfully'); 
    }

    public function edit(Product $product){
        return view('products.edit', ['product' => $product]);
    }

    public function update(Request $request, Product $product){
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'qty' => 'required|numeric|min:1',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/', 
            'description' => 'nullable|string|max:255'
        ]);

        $product->update($data);
        return redirect()->route('product.index')->with('success', 'Product updated successfully'); 
    }

    public function destroy(Product $product){
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product deleted successfully'); 
    }
}
