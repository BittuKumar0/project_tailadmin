<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    public function dashboard()
    {
        // You can fetch seller data here if needed
        return view('seller.dashboard'); // make sure this view exists
    }
}
