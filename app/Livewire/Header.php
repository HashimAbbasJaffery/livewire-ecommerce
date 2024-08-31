<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;


class Header extends Component
{
    public $cart;
    public $overallPrice;
    public function mount() {
        $this->cart = [];
        $this->overallPrice = 0;
    }
    public function render()
    {
        $cart = $this->cart;
        return view('livewire.header', compact("cart"));
    }
    public function smushDuplicateAndPush(array $item, int $quantity) {
        $flag = false;
        foreach($this->cart as &$inCartItem) {
            if($item["id"] === $inCartItem["id"]) {
                $flag = true;
                $inCartItem["quantity"] += $quantity;
            }
        }

        if(!$flag) array_push($this->cart, $item);
    }

    #[On('add-to-cart')]
    public function addToCart($item, $quantity = 1) {
        $item["quantity"] = $quantity;
        $this->smushDuplicateAndPush($item, $quantity);

        $price = array_sum(array_map(function($item) {
            return $item["quantity"] * ($item["new_price"] ?? $item["price"]);
        }, $this->cart));

        $this->overallPrice = $price;
    }
}
