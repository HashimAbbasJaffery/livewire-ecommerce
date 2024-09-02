<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product as Prod;
use App\Livewire\Header;

class Product extends Component
{
    public Prod $product;
    public function mount(Prod $product) {
        $this->product = $product;
    }
    public function render()
    {
        $product = $this->product;
        $image = ($product->images()->first())?->image ?? null;
        // dd($product);
        return view('livewire.product', compact("product", "image"));
    }
    public function placeholder()
    {
        return <<<'HTML'
        <div>
            <!-- Loading spinner... -->
            <p>Loading...</p>
        </div>
        HTML;
    }

    public function addToCart($item) {

        // Dispatching To Livewire Component
        $this->dispatch('add-to-cart', $item)->to(Header::class);

        // Dispatching to the browser

    }
}
