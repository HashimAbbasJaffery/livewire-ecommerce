<?php

use App\Http\Controllers\ProfileController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\Color;

Route::get('/', function () {
    $products = Product::withCount("orders")->whereHas("images")->orderByDesc("orders_count")->limit(4)->get();
    $new_arrivals = Product::whereHas("images")->latest()->limit(12)->get();

    return view('welcome', compact("products", "new_arrivals"));
});

Route::get("/products", \App\Livewire\Page\Products::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
