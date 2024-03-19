@extends('master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <form action="login" method="POST">
                @csrf
                <div class="form-group">
                  <label for="userEmail">Email address</label>
                  <input type="email" class="form-control" id="userEmail" name="userEmail" aria-describedby="emailHelp" placeholder="Enter email">
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                  <label for="userPassword">Password</label>
                  <input type="password" class="form-control" id="userPassword" name="userPassword" placeholder="Password">
                </div>
                <button type="submit" name="loginButton" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
{{-- 
    php artisan route:cache
    php artisan route:clear 
--}}