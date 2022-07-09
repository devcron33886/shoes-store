<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Variation;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function __invoke()
    {
        $products=Product::with('variations')
        ->paginate(12);
        $categories=Category::all();

        return view('shop.index',compact('products','categories'));
    }
}
