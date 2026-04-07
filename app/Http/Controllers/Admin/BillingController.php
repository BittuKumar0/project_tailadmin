<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BillingController extends Controller
{
    public function invoices()
    {
        return view('admin.billing.invoices');
    }

    public function createInvoice()
    {
        return view('admin.billing.create-invoice');
    }

    public function transactions()
    {
        return view('admin.billing.transactions');
    }
}