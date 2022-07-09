<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderConfirmationController extends Controller
{
    public function __invoke(Order $order)
    {
return view('orders.confirmation',compact('order'));
    }
}
