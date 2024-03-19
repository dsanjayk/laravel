<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;

Route::get('/login', function () {
    return view('login');
});

Route::post("/login", [UserController::class,'login']);
Route::get("/logout", function(){
    Session::forget('user');
    return redirect('login');
});

Route::get("/", [ProductController::class,'index']);
// php artisan route:clear
Route::get("/detail/{id}", [ProductController::class,'detail']);

Route::post("add_to_cart", [ProductController::class,'addToCart']);

Route::get("cart_products", [ProductController::class,'cartProductList']);

Route::get("remove_cart_product/{id}", [ProductController::class,'removeCartProduct']);