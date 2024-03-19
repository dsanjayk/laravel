@extends('master')
@section('content')
<!DOCTYPE html>
<html>
<head>
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

<div class="card">
  <img src="{{$product->gallery}}" alt="Denim Jeans" style="width:100%">
  <h1>{{$product->name}}</h1>
  <p class="price">${{$product->price}}</p>
  <p>{{$product->description}}</p>
  <form action="/add_to_cart" method="POST">
    @method('POST')
    @csrf
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <input type="hidden" name="user_id" value="{{Session::get('user')}}">
    <p><input type="submit" class="addToCart" value="Add to Cart" ></p>
  </form>
  <p><button class="btn btn-info">Buy Now</button></p>
</div>

</body>
</html>

@endsection