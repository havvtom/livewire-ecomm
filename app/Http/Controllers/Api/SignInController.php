<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SignInController extends Controller
{
    public function __invoke( Request $request ){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$token = auth()->attempt($request->only('email', 'password'))){
           
        }
    }
}
