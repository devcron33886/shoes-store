<?php

namespace App\Http\Livewire;

use App\Basket\Contracts\BasketInterface;
use App\Models\Variation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductSelectorComponent extends Component
{
    public $product;

    public $initialVariation;

    public $skuVariant;

    protected $listeners = [
        'skuVariantSelected'
    ];

    public function mount()
    {
        $this->initialVariation = $this->product->variations->sortBy('order')->groupBy('type')->first();
    }

    public function skuVariantSelected($variantId)
    {
        if (!$variantId) {
            $this->skuVariant = null;
            return;
        }
        $this->skuVariant = Variation::find($variantId);


    }

    public function addToCart(BasketInterface $cart)
    {
        $cart->add($this->skuVariant, 1);
        $this->emit('cart.updated');

        $this->dispatchBrowserEvent('notification',[
            'body'=>$this->skuVariant->product->name.' added to shopping cart',
            'timeout'=>4000
        ]);
    }

    public function render(): Factory|View|Application
    {
        return view('livewire.product-selector-component');
    }
}
