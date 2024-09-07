<?php

namespace App\Livewire\Page;

use Livewire\Component;
use App\Models\Product;

class Home extends Component
{
    public function render()
    {
        if(session()->has("login")) {
            $this->dispatch("loggedin");
        }
        $products = Product::withCount("orders")->whereHas("images")->orderByDesc("orders_count")->limit(4)->get();
        $new_arrivals = Product::whereHas("images")->latest()->limit(12)->get();
        return view('livewire.page.home', compact("products", "new_arrivals"));
    }
}
