<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Middleware\RedirectIfCartEmpty;

class CheckoutIndexController extends Controller
{

    public function __construct()
    {
        $this->middleware(RedirectIfCartEmpty::class);
    }

    public function __invoke()
    {
        return view('checkout');
    }

}
