<?php

namespace App\Services;
use App\Livewire\Header;
use App\Models\User;

class Wishlist
{
    /**
     * Create a new class instance.
     */
    public $events;
    public function __construct()
    {
        $this->events = [
            "wishlist" => [
                "class" => Header::class,
                "data" => ""
            ],
        ];
    }
    public function wishlist($is_wishlist, $id) {
        $action = (!$is_wishlist) ? "attach" : "detach";
        User::find(auth()->user()->id)->wishlists()->$action($id);

        $this->events["wishlist"]["data"] = $action;
        if($action === "attach")
            $this->events["wishlisted"] = null;
        else
            $this->events["remove-wishlist"] = null;

        return $this->events;
    }
}
