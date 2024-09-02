<?php

namespace App\Livewire\Page;

use App\OrderStatus;
use Livewire\Component;

class Checkout extends Component
{
    public $cart;
    public $first_name;
    public $last_name;
    public $street_address;
    public $apartment;
    public $city;
    public $email;
    public $phone;
    public $order_notes;
    public $status;
    public $user_id;
    public function mounted() {
        $this->status = OrderStatus::INPROGRESS->value;
        $this->user_id = auth()->user() ?? null;
    }

    public function mount() {
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
    }
    public function render()
    {
        return view('livewire.page.checkout');
    }
    public function createOrder() {
        dd("created");
    }
}
