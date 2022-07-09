<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ProductGalleryComponent extends Component
{
    public $product;

    public $selectedImageUrl;

    public function mount()
    {
        $this->selectedImageUrl=$this->product->getFirstMediaUrl();
    }

    public function selectImage($url)
    {
        $this->selectedImageUrl= $url;
    }
    public function render(): Factory|View|Application
    {
        return view('livewire.product-gallery-component');
    }
}
