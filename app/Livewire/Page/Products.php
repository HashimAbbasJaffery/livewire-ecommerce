<?php

namespace App\Livewire\Page;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Livewire\Component;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Products extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $message;
    public $categoriesList;
    public $colorsList;
    public $price;
    public function mount() {
        $this->categoriesList = [];
        $this->colorsList = [];
        $this->price = [0, 0];
    }

    #[On('price-change')]
    public function changePrice($minima, $maxima) {
        $this->price[0] = substr($minima, 1);
        $this->price[1] = substr($maxima, 1);
    }

    public function render()
    {
        $categories = Category::withCount("products")->whereHas("products")->limit(10)->get();
        $colors = Color::all();
        $products = Product::filter(["categories" => $this->categoriesList, "colors" => $this->colorsList])
                            ->whereBetween("price", $this->price)
                            ->paginate(8);
        return view('livewire.page.products', compact("categories", "colors", "products"));
    }
    #[On('ordered-product')]
    public function ordered() {
        dd("lol");
    }

}
