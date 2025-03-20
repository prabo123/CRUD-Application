<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // ✅ Corrected model name

class ProductController extends Controller
{
    public function index(){
        $products = Product::all(); // ✅ Corrected class name
        return view('products.index', ['products' => $products]); // ✅ Corrected variable reference
    }

    public function create() {
        return view('products.create'); 
    }

    public function store(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'qty' => 'required|numeric',
            'price' => 'required|decimal:0.2', 
            'description' => 'nullable'
        ]);

        $newProduct = Product::create($data); 

        return redirect()->route('product.index'); 
    }

    public function edit(Product $product){
        return view('products.edit', ['product'=> $product ]);
    }

    public function update (Product $product,Request $request){
       $data= $request->validate ([
        'name' => 'required',
        'qty' => 'required|numeric',
        'price' => 'required|decimal:0.2', 
        'description' => 'nullable'
       ]);
       $product->update($data);
       return redirect(route('product.index'))->with('success','product updated sucesfully');
    }


    public function destory (Product $product){
        $product->delete($data);
        return redirect(route('product.index'))->with('success','product deleted sucesfully');
     }
 

    
}

