<?php

namespace App\Livewire\Page;

use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $overallPrice;
    public function mount(\App\Services\Cart $cart) {
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
        $this->overallPrice = session()->has("overallPrice") ? session()->get("overallPrice") : 0;
    }
    public function updatedCart() {
        session()->put("cart", $this->cart);
        $this->dispatch("update-quantity", $this->cart)->to(\App\Livewire\Header::class);
    }
    public function render()
    {
        return view('livewire.page.cart');
    }
    public function removeFromCart($id, \App\Services\Cart $cart) {
        $this->dispatch("remove-from-cart", $id)->to(\App\Livewire\Header::class);
        [$remaining_items, $price] = $cart->removeFromCart($this->cart, $id);
        $this->cart = $remaining_items;
        $this->overallPrice = $price;
    }
}
