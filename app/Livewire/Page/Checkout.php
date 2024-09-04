<?php

namespace App\Livewire\Page;

use App\Livewire\Forms\OrderForm;
use App\OrderStatus;
use Livewire\Component;
use Response;

class Checkout extends Component
{
    public $cart;
    public OrderForm $form;
    public $status;
    public $user_id;
    public function mount() {

        $this->status = OrderStatus::INPROGRESS->value;
        $this->user_id = auth()->user() ?? null;
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
        abort_if(!$this->cart, 403, "Add Items in cart!");
    }
    public function render()
    {
        return view('livewire.page.checkout');
    }
    public function createOrder() {
        $order = \App\Models\Order::create([
            ...$this->form->toArray(),
            "status" => 0,
            "user_id" => $this->user_id
        ]);
        $order->products()->sync(collect($this->cart)->pluck("id"));
        $this->cart = [];
        session()->put("cart", $this->cart);
        return redirect()->to(route("ordered"));
    }
}
