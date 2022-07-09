<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\View\Component;

class AsideComponent extends Component
{


    public function render()
    {
        $categories=Category::all();
        return view('components.aside-component',compact('categories'));
    }
}
