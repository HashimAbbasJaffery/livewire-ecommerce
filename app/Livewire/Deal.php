<?php

namespace App\Livewire;

use Livewire\Component;

class Deal extends Component
{
    public $deals;
    public function render()
    {
        return view('livewire.deal');
    }
}
