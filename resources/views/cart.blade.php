<?php
use App\Models\Product; 
?>
@extends('master')
@section('content')
<style>
.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    max-width: 300px;
    margin: auto;
    text-align: center;
    font-family: arial;
}

.price {
    color: grey;
    font-size: 22px;
}

.card button {
    border: none;
    outline: 0;
    padding: 12px;
    color: white;
    background-color: #000;
    text-align: center;
    cursor: pointer;
    width: 100%;
    font-size: 18px;
}

.card button:hover {
    opacity: 0.7;
}
</style>
</head>
<body>

<h2 style="text-align:center">Product Details</h2>
@foreach($cart_products as $item)
<?php
  $itemDetails = Product::find($item->product_id);
?>
<div class="card">
    <img src="{{$itemDetails->gallery}}" alt="Denim Jeans" style="width:100%">
    <h1>{{$itemDetails->name}}</h1>
    <p class="price">${{$itemDetails->price}}</p>
    <p>{{$itemDetails->description}}</p>
    <a class="btn btn-info" href="remove_cart_product/{{$itemDetails->id}}">Remove From Cart</a>
</div>
<br>
@endforeach   
@endsection