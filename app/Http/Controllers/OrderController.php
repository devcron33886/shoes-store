<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function __invoke(Request $request)
    {
        $orders=$request->user()->orders()->latest()
            ->with('variations.product','variations.media','variations.ancestorsAndSelf','shippingtype')
            ->get();
        return view('orders.index',compact('orders'));
    }
}
