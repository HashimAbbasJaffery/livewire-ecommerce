<?php

namespace App\Models;

use App\Courier\PostEx;
use App\Observers\OrderObserver;
use DB;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(OrderObserver::class)]
class Order extends Model
{
    use HasFactory;
    public $afterCommit = true;
    protected $guarded = ["id", "created_at", "updated_at"];
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function products() {
        return $this->belongsToMany(Product::class)
                ->withPivot('quantity', 'price', "variant");
    }
}
