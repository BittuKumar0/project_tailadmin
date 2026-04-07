<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use PDF;

class InvoiceController extends Controller
{
public function download($id)
{
    $order = Order::findOrFail($id); // order load

    $pdf = PDF::loadView('invoice.pdf', compact('order')); // view ke liye pass kar rahe

    return $pdf->download('invoice-'.$order->id.'.pdf');
}
    
}

