<?php

namespace App\Livewire\Page;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function render()
    {
        $user = User::with("orders.products")->find(auth()->id());
        $orders = $user->orders;

        return view('livewire.page.orders', compact("orders"));
    }
}
