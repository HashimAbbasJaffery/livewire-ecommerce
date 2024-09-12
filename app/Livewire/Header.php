<?php

namespace App\Livewire;

use App\Livewire\Page\Products;
use App\Services\Cart;
use Livewire\Component;
use Livewire\Attributes\On;


class Header extends Component
{
    public $cart;
    public $overallPrice;
    public $search = "";
    public function mount() {
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
        $this->overallPrice = session()->has("overallPrice") ? session()->get("overallPrice") : 0;
    }
    public function render()
    {
        return view('livewire.header');
    }
    #[On('update-quantity')]
    public function changeQuantity($cart) {
        $this->cart = $cart;
    }
    protected function smushDuplicateAndPush(array $item, int $quantity) {
        $flag = false;
        foreach($this->cart as &$inCartItem) {
            if($item["id"] === $inCartItem["id"]) {
                $flag = true;
                $inCartItem["quantity"] += $quantity;
            }
        }

        if(!$flag) array_push($this->cart, $item);

        session()->put("cart", $this->cart);
    }

    #[On('add-to-cart')]
    public function addToCart($item, $quantity = 1) {
        if(isset($item["item"])) {
            $quantity = $item["quantity"];
            $item = $item["item"];
        }
        $item["quantity"] = $quantity;
        $this->smushDuplicateAndPush($item, $quantity);

        $price = array_sum(array_map(function($item) {
            return $item["quantity"] * ($item["new_price"] ?? $item["price"]);
        }, $this->cart));

        $this->overallPrice = $price;
        session()->put("overallPrice", $price);


        $this->dispatch('added-to-cart', ['item' => $item]);
    }

    #[On('remove-from-cart')]
    public function removeFromCart($id, Cart $cart) {
        [$remaining_items, $total] = $cart->removeFromCart($this->cart, $id);
        $this->cart = $remaining_items;
        session()->put("cart", $this->cart);

        $this->overallPrice = $total;
        session()->put("overallPrice", $this->overallPrice);


        $this->dispatch('removed-from-cart');
    }
    public function updatedSearch() {
        $this->dispatch("search-product", $this->search)->to(Products::class);
    }
}
