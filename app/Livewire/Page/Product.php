<?php

namespace App\Livewire\Page;

use App\Livewire\Header;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Product extends Component
{
    public \App\Models\Product $product;

    public $quantity = 1;
    public function mount(\App\Models\Product $product) {
        $this->product = $product;
    }
    public function render()
    {
        $product = $this->product;
        return view('livewire.page.product', compact("product"));
    }
    public function addToCart() {
        $this->dispatch("add-to-cart", [ "item" => $this->product, "quantity" => $this->quantity ])->to(Header::class);
    }
}
