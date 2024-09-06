<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $products = Product::withCount("orders")->whereHas("images")->orderByDesc("orders_count")->limit(4)->get();
    $new_arrivals = Product::whereHas("images")->latest()->limit(12)->get();

    return view('welcome', compact("products", "new_arrivals"));
})->name("home");


Route::get("/product/{product}", \App\Livewire\Page\Product::class)->name("product");
Route::get("/products", \App\Livewire\Page\Products::class)->name("products");
Route::get("/cart", \App\Livewire\Page\Cart::class)->name("cart");
Route::get("/checkout", \App\Livewire\Page\Checkout::class)->name("checkout");
Route::get("/ordered", \App\Livewire\OrderProduct::class)->name("ordered");

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
