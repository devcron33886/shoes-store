<?php

namespace App\Http\Livewire;

use App\Basket\Contracts\BasketInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartComponent extends Component
{
    protected $listeners = [
        'cart.updated' => '$refresh'
    ];

    public function render(BasketInterface $basket): Factory|View|Application
    {
        return view('livewire.cart-component', compact('basket'));
    }
}
