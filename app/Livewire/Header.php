<?php

namespace App\Livewire;

use App\Livewire\Page\Products;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;
use App\Services\Cart;
use Auth;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;


class Header extends Component
{
    use WithPagination;
    public $cart;
    public $overallPrice;
    public $search = "";
    public $perPage = 8;
    public $total_wishlists;
    public function mount() {
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
        $this->overallPrice = session()->has("overallPrice") ? session()->get("overallPrice") : 0;
        $this->total_wishlists = (User::find(auth()->user()?->id ?? null))?->wishlists()->count() ?? 0;
    }
    public function render()
    {
        if($this->search) {
            $products = Product::where("title", "like", "%" . $this->search . "%")->paginate($this->perPage);
        } else {
            $products = [];
            $this->perPage = 8;
        }

        $total_wishlists = $this->total_wishlists;
        return view('livewire.header', compact("products", "total_wishlists"));
    }

    #[On('wishlist')]
    public function addToWishlist($status) {
        if($status === "attach") {
            $this->total_wishlists++;
        } else {
            $this->total_wishlists--;
        }
    }
    #[On('update-quantity')]
    public function changeQuantity($cart) {
        $this->cart = $cart;
    }
    public function loadMore() {
        $this->perPage += 8;
    }
    protected function smushDuplicateAndPush(array $item, int $quantity) {
        $flag = false;

        // ID based smushing

        // foreach($this->cart as &$inCartItem) {
        //     if(($item["id"] === $inCartItem["id"])) {
        //         $flag = true;
        //         $inCartItem["quantity"] += $quantity;
        //     }
        // }

        foreach($this->cart as &$inCartItem) {
            if($item["variant"] === $inCartItem["variant"]) {
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
            $variant = $item["variant"];
            $item = $item["item"];
        }
        $item["quantity"] = $quantity;
        $item["variant"] = $variant;
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
        $this->perPage = 8;
    }

}
