<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Session;

class ProductController extends Controller
{
    //
    function index()
    {
        $data = Product::all();
        return view('product', ['products'=>$data]);
    }

    function detail($id)
    {
        $data = Product::where('id',$id)->first();
        return view('details', ['product'=>$data]);
    }

    function addToCart(Request $req){
        if($req->session()->has('user')){
            $cart = new Cart();
            $cart->user_id = $req->session()->get('user')['id'];
            $cart->product_id = $req->product_id;
            $cart->save();
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return Cart::where('user_id',$userId)->count();
    }

    function cartProductList()
    {
        $userId = Session::get('user')['id'];
        $productLists = Cart::where('user_id',$userId)->get();
        return view('cart', ['cart_products'=>$productLists]);
    }

    function removeCartProduct($id)
    {
        Cart::where('product_id',$id)->delete();
        return redirect('cart_products');
    }
}
