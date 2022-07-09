<?php

namespace App\Http\Livewire;

use App\Models\Variation;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductVariationDropDownComponent extends Component
{
    public $variations;

    public $selectedVariation;

    public function getSelectedVariationModelProperty()
    {
        if (!$this->selectedVariation) {
            return;
        }
        return Variation::find($this->selectedVariation);
    }

    public function updatedSelectedVariation()
    {
        $this->emitTo('product-selector-component','skuVariantSelected',null);

        if ($this->selectedVariationModel?->sku)
        {
            $this->emitTo('product-selector-component','skuVariantSelected',$this->selectedVariation);
        }
    }


    public function render(): Factory|View|Application
    {
        return view('livewire.product-variation-drop-down-component');
    }
}
