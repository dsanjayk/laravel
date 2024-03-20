<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index',['products'=>$products]);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $req)
    {
        // validate data
        $req->validate([
            'productName' => 'required',
            'productDescription' => 'required',
            'productImage' => 'required|mimes:jpeg,jpg,png,gif:max:1000',
        ]);

        // if($)

        // upload image
        $imageName = time().'.'.$req->productImage->extension();
        $req->productImage->move(public_path('products'), $imageName);
        
        // insert data to table
        $product = new Product;
        $product->name = $req->productName;
        $product->description = $req->input('productDescription');
        $product->image = $imageName;

        $product->save();
        return redirect()->back()->with('success','Successfully added product');
    }
}
