<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $categories=Category::all();
        $products=Product::trending()->get();
        return view('welcome',compact('categories','products'));
    }
}
