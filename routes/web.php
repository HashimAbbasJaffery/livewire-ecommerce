<?php

use App\Courier\PostEx;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get("/test", function() {
    $postex = (new PostEx(env("COURIER_POSTEX")))->track("2005573000010/");
    dd($postex);
});

Route::get('/', \App\Livewire\Page\Home::class)->name("home");


Route::get("/test", function() {
    session()->put("cart", []);
});

Route::get("/product/{product:slug}", \App\Livewire\Page\Product::class)->name("product");
Route::get("/products", \App\Livewire\Page\Products::class)->name("products");
Route::get("/wishlists", \App\Livewire\Page\Wishlist::class)->name("wishlists");
Route::get("/cart", \App\Livewire\Page\Cart::class)->name("cart");
Route::get("/checkout", \App\Livewire\Page\Checkout::class)->name("checkout");
Route::get("/ordered", \App\Livewire\OrderProduct::class)->name("ordered");
Route::get("/track", App\Livewire\Page\Track::class)->name("track");
Route::get("/orders", App\Livewire\Page\Orders::class)->name("orders");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
