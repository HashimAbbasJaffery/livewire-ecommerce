<?php

namespace App\Livewire\Page;

use App\SortingEnum;
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
    public $categoriesList = [];
    public $colorsList = [];
    public $price = [0,0];
    public $keyword = "";
    public $first_loading = true;


    #[On('price-change')]
    public function changePrice($minima, $maxima) {
        $this->price[0] = substr($minima, 1);
        $this->price[1] = substr($maxima, 1);
    }
    protected function filters() : array {
        return [
            "categories" => $this->categoriesList,
            "colors" => $this->colorsList,
        ];
    }

    public function render()
    {
        $categories = Category::withCount("products")->whereHas("products")->limit(10)->get();
        $colors = Color::get();
        $products = Product::filter($this->filters())
                            ->with("images")
                            ->whereBetween("price", $this->price)
                            ->where("title", "like", "%" . $this->keyword . "%")
                            ->paginate(8);
        $this->first_loading = false;
        return view('livewire.page.products', compact("categories", "colors", "products"));
    }
    #[On('ordered-product')]
    public function ordered() {
    }
    public function clearFilters() {
        $this->categoriesList = [];
        $this->colorsList = [];
        $this->price = [0, 1000];
    }
    #[On('search-product')]
    public function searchByKeyword($keyword) {
        $this->keyword = $keyword;
    }

}
