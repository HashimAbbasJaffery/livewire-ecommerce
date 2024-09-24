<?php

namespace App\Models;

use App\SortingEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $with = ["images", "orders"];
    protected $guarded = ["id", "created_at", "updated_at"];
    public function images() {
        return $this->hasMany(Image::class)->select("color", "image", "product_id");
    }
    public function orders() {
        return $this->belongsToMany(Order::class);
    }
    public function categories() {
        return $this->belongsToMany(Category::class);
    }
    public function wishlists() {
        return $this->BelongsToMany(User::class, "wishlist");
    }

    public function scopeFilter(Builder $query, $filters) {
        if($filters["categories"]) {
            $query->whereHas("categories", function($query) use($filters) {
                $query->whereIn("categories.id", $filters["categories"]);
            });
        }
        $query->when($filters["colors"] ?? null, function($query) use ($filters) {
            $query->whereHas("images", function($query) use ($filters) {
                $query->whereIn("images.color", $filters["colors"]);
            });
        });
    }
}
