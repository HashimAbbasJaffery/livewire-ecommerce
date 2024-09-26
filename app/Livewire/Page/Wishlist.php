<?php

namespace App\Livewire\Page;

use App\Livewire\Header;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Wishlist extends Component
{
    public User $user;
    use WithPagination;
    public function render()
    {
        $this->user = User::find(auth()->user()->id);
        $wishlists = $this->user->wishlists()->paginate(8);
        return view('livewire.page.wishlist', compact("wishlists"));
    }
    public function remove($id) {
        $wishlists = $this->user->wishlists()->detach($id);
    }
    public function addToCart($item) {
        $this->dispatch("add-to-cart", ["item" => $item, "quantity" => 1, "variant" => $item["images"][0]["image"]])->to(Header::class);
    }
}
