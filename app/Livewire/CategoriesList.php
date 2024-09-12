<?php

namespace App\Livewire;

use Livewire\Attributes\Modelable;
use Livewire\Component;

class CategoriesList extends Component
{
    #[Modelable]
    public $list = [];
    public $id;
    public $category;
    public function render()
    {
        return view('livewire.categories-list');
    }
}
