<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $token = $request->user()->createToken($request->email);
            return $token;
        }else {
            return "Usuario y Password incorrectos";
        }
    }

    public function logout(Request $request)
    {
        auth('sanctum')->user()->tokens()->delete();
    }
}
