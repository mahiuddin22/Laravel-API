<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    function generateToken(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email'=>$email, 'password'=>$password]))
        {
            return Auth::user();
        }else{
            return response()->json(['Error'=>'User not found'],404);
        }
    }
}
