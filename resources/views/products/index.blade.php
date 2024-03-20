@extends('master')
@section('content')
<div class="container-fluid mt-3">
  <h3>Products List</h3> <a href="/addproduct" class="btn btn-primary">Add New Product</a>
  <div class="container mt-3">     
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>Name</th>
          <th>Description</th>
          <th>Image</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($products as $item)
          <tr>
            <td>{{$item->name}}</td>
            <td>{{$item->description}}</td>
            <td><img src="{{ asset('products/'.$item->image.'') }}" height="60px" width="100px" alt="{{$item->name}}"></td>
            <td><a href="" class="btn btn-info">Edit</a> | <a href="" class="btn btn-danger">Delete</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection