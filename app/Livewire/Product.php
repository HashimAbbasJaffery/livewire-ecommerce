<?php

namespace App\Livewire;

use App\Models\User;
use App\Services\Wishlist;
use Livewire\Attributes\On;
use Livewire\Component;
use App\Models\Product as Prod;
use App\Livewire\Header;

class Product extends Component
{
    public Prod $product;
    public $thumbnail;
    public $images;
    public bool $is_wishlist;
    public function mount(Prod $product) {
        $this->product = $product;
        $image = ($product->images()->first())?->image ?? null;
        $this->images = $product->images()->limit(4)->get();
        $this->thumbnail = $image;
        $this->is_wishlist = $product->wishlists()?->find(auth()->user()?->id ?? null)?->exists() ?? false;

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
        $this->dispatch('add-to-cart', ["item" => $item, "quantity" => 1, "variant" => $this->thumbnail])->to(Header::class);
    }
    #[On("wishlist-item")]
    public function wishlist($id, Wishlist $wishlist) {
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
