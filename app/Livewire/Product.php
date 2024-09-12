<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product as Prod;
use App\Livewire\Header;

class Product extends Component
{
    public Prod $product;
    public $thumbnail;
    public $images;
    public function mount(Prod $product) {
        $this->product = $product;
        $image = ($product->images()->first())?->image ?? null;
        $this->images = $product->images()->limit(4)->get();
        $this->thumbnail = $image;

    }
    public function render()
    {
        $product = $this->product;
        $images = $this->images;
        return view('livewire.product', compact("product", "images"));
    }
    public function changeThumbnail($image) {
        $this->thumbnail = $image;
    }

    public function addToCart($item) {
        // Dispatching To Livewire Component
        $this->dispatch('add-to-cart', $item)->to(Header::class);

        // Dispatching to the browser

    }
}
