<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function __invoke()
    {
        $products = Product::might()
            ->get();

        return view('cart.index', compact('products'));
    }
}
