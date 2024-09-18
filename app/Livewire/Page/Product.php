<?php

namespace App\Livewire\Page;

use App\Livewire\Header;
use App\Models\User;
use App\Services\Wishlist;
use Livewire\Component;

class Product extends Component
{
    public \App\Models\Product $product;

    public $quantity = 1;
    public $selected;
    public bool $is_wishlist;
    public $images;
    public function mount(\App\Models\Product $product) {
        $this->product = $product;
        $this->selected = $product->images[0]->image;
        $this->is_wishlist = $product->wishlists()?->find(auth()->user()?->id ?? null)?->exists() ?? false;
    }
    public function render()
    {
        $product = $this->product;
        $images = $this->product->images->sortBy(fn($image) => $image->image !== $this->selected->images);
        return view('livewire.page.product', compact("product"));
    }
    public function addToCart() {
        $this->dispatch("add-to-cart", [ "item" => $this->product, "quantity" => $this->quantity ])->to(Header::class);
    }
    public function changeSelected($image) {
        $this->selected = $image;
    }
    public function addToWishlist($id, Wishlist $wishlist) {
        $events = $wishlist->wishlist($this->is_wishlist, $id);

        foreach($events as $event => $value) {
            if($value) {
                $this->dispatch($event, $value["data"])->to($value["class"]);
            } else {
                $this->dispatch($event);
            }
        }

        $this->is_wishlist = ! $this->is_wishlist;
    }
}
