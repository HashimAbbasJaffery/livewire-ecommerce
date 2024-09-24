<?php

namespace App\Livewire\Page;

use App\Courier\PostEx;
use App\Livewire\Forms\OrderForm;
use App\Mail\PlacedOrder;
use App\OrderStatus;
use DB;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Mail;
use Response;

class Checkout extends Component
{
    public $cart;
    public OrderForm $form;
    public $status;
    public $user_id;
    public array $cities;

    public function mount() {

        $this->status = OrderStatus::INPROGRESS->value;
        $this->user_id = auth()->user()?->id ?? null;
        $this->cart = session()->has("cart") ? session()->get("cart") : [];
        abort_if(!$this->cart, 403, "Add Items in cart!");
        $this->cities = (new PostEx(env("COURIER_POSTEX")))->getCities()["dist"];
    }
    public function render()
    {
        return view('livewire.page.checkout');
    }
    public function save() {
        $validated = $this->validate();
        abort_if(!session()->get("cart"), 403);
        $order = "";

        DB::transaction(function() {
            $order = \App\Models\Order::create([
                ...$this->form->toArray(),
                "status" => 0,
                "user_id" => $this->user_id
            ]);
            $order->products()->sync(
                collect($this->cart)->mapWithKeys(function ($product) {
                    return [
                        $product['id'] => [
                            'quantity' => $product['quantity'],
                            'price' => $product["new_price"] ?? $product['price'],
                            "variant" => $product["variant"]
                        ]
                    ];
                })->toArray()
            );
        });

        $this->cart = [];
        Mail::to($this->form->email)->queue(new PlacedOrder(session()->get("cart")));
        session()->put("cart", $this->cart);
        return redirect()->to(route("ordered", ));
    }
    public function changeCity(array $city) {
        $this->form->city = $city["operationalCityName"];
    }
}
