<?php

namespace App\Http\Livewire;

use App\Basket\Contracts\BasketInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CartItemComponent extends Component
{
    public $variation;

    public $quantity;

    public function mount()
    {
        $this->quantity = $this->variation->pivot->quantity;
    }

    public function updatedQuantity($quantity)
    {
        app(BasketInterface::class)->changeQuantity($this->variation, $quantity);

        $this->emit('cart.updated');

        $this->dispatchBrowserEvent('notification', [
            'body' =>$this->variation->product->name.' quantity updated'
        ]);
    }

    public function remove(BasketInterface $basket)
    {
        $basket->remove($this->variation);

        $this->emit('cart.updated');

        $this->dispatchBrowserEvent('notification',[
            'body'=>$this->variation->product->name.' is removed in the cart.'
        ]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.cart-item-component');
    }
}
