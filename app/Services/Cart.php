<?php

namespace App\Services;

class Cart
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
    public function totalPrice($cart) {
        $price = array_sum(array_map(function($item) {
            return $item["quantity"] * ($item["new_price"] ?? $item["price"]);
        }, $cart));
        return $price;
    }
    public function quantityValidator($quantity) {
        if($quantity <= 0) return 1;

        return $quantity;
    }
    public function removeFromCart($cart, $id) {
        $remaining_items = array_filter($cart, function($inCartItem) use ($id){
            return $inCartItem["id"] != (int)$id;
        });

        return [$remaining_items, $this->totalPrice($remaining_items)];
    }
}
