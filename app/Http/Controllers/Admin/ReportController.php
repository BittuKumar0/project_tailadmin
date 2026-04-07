<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sales()
{
    // Example data (later you can replace with real orders data)
    return view('admin.reports.sales');
}

public function analytics()
{
    return view('admin.reports.analytics');
}
}
