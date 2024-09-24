<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $with = ["color"];
    protected $guarded = ["id", "created_at", "updated_at"];

    public function product() {
        return $this->belongsTo(Product::class);
    }
    public function color() {
        return $this->belongsTo(Color::class, "color");
    }
}
