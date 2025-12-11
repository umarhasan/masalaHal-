<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Caryley\LaravelInventory\HasInventory;

class Product extends Model
{
    use HasFactory,HasInventory;
    protected $guarded = [];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function colors()
    {
        return $this->hasMany(ProductColor::class);
    }

    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function reviews()
    {
        return $this->hasMany(ProductReview::class);
    }
    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scopes
    public function scopeApproved($q)
    {
        return $q->where('is_approved', 1);
    }
    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
}
