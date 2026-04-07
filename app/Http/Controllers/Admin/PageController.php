<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PageController extends Controller
{
     public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function calendar() { return view('admin.calendar'); }
    public function profile() { return view('admin.profile'); }
    public function task() { return view('admin.task'); }
    public function forms() { return view('admin.forms'); }
    public function tables() { return view('admin.tables'); }
    public function pages() { return view('admin.pages'); }
}