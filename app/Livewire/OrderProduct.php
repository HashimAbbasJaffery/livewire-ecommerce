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
        if(!session()->has("tracking_number")) {
            abort(403);
        }
        return view('livewire.order-product');
    }
}
