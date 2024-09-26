<?php

namespace App\Observers;
use App\Courier\PostEx;
use App\Models\Order;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class OrderObserver implements ShouldHandleEventsAfterCommit
{
    public function created(Order $order) {
        $price = 0;
        foreach($order->products as $product) {
            $price += $product->new_price ?? $product->price;
        }

        $courier = (new PostEx(env("COURIER_POSTEX")))->createOrder([
            "ref" => 2000 + $order->id,
            "price" => $price + session()->get("shipping") ?? 0,
            "name" => $order->first_name . " " . $order->last_name,
            "phone" => $order->phone,
            "email" => "{$order->street_address}, {$order->apartment}, {$order->city}, Pakistan",
            "order_notes" => $order->order_notes,
            "city" => $order->city,
            "invoiceDivision" => 0,
            "items_count" => count($order->products),
            "orderType" => "Normal"
        ]);

        if($courier["statusCode"] === "200") {
            $order->tracking_number = $courier["dist"]["trackingNumber"];
            $order->save();
        }
        session()->flash("tracking_number", $order?->tracking_number ?? "AHBSHD");
    }
}
