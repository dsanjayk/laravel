<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function login(Request $req)
    {
        $user = User::where(['email'=>$req->userEmail])->first();

        if(!$user || !Hash::check($req->userPassword,$user->password)){
            return "Username or Password is not matched";
        }else{
            $req->session()->put('user',$user);
            return redirect('/');
        }
        
    }
}
