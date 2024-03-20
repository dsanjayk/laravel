@extends('master')
@section('content')
<div class="container-fluid mt-3">
  <h3>Add Product</h3>
  <div class="container mt-3">
    <h2>Add Product Form</h2>
    <p>
        @if($success = Session::get('success'))
            <span class="alert alert-success alert-block">{{$success}}</span>
        @endif
    </p>
    <form action="/saveproduct" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="mb-3 mt-3">
        <label for="productName">Product Name:</label>
        <input type="text" class="form-control" id="productName" placeholder="Enter Product Name" name="productName" value="{{old('productName')}}">
        @if($errors->has('productName'))
            <span class="text-danger">{{$errors->first('productName')}}</span>
        @endif
    </div>
      <div class="mb-3">
        <label for="productDescription">Product Description:</label>
        <textarea class="form-control" id="productDescription" name="productDescription">{{old('productDescription')}}</textarea>
        @if($errors->has('productDescription'))
            <span class="text-danger">{{$errors->first('productDescription')}}</span>
        @endif
      </div>
      <div class="mb-3 mt-3">
        <label for="productImage">Product Image:</label>
        <input type="file" class="form-control" id="productImage" placeholder="Upload Product Image" name="productImage">
        @if($errors->has('productImage'))
            <span class="text-danger">{{$errors->first('productImage')}}</span>
        @endif
      </div>
      <button type="submit" class="btn btn-primary">Save Product</button>
    </form>
  </div>
</div>
@endsection