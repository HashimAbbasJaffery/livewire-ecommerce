<?php

namespace App\Livewire;

use Livewire\Component;

class OrderProduct extends Component
{
    public function mount() {
        $this->dispatch("ordered");
    }
    public function render()
    {
        return view('livewire.order-product');
    }
}
