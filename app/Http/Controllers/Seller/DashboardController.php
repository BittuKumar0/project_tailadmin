<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

     public function index()
    {
        return view('seller.dashboard'); // We'll create this view next
    }
     public function dashboard()
    {
        // Fetch any data you need for seller dashboard
        return view('seller.dashboard'); // resources/views/seller/dashboard.blade.php
    }

}
