<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = []; // or explicitly list fillable fields

    protected $casts = [
        'meta' => 'array',      // stores payment method, notes, etc.
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ===== Relationships =====
    public function items()
    {
        return $this->hasMany(OrderItem::class,);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optional: get total quantity of items
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }

    // Optional: get formatted total
    public function getFormattedTotalAttribute()
    {
        return 'Rs. ' . number_format($this->total, 2);
    }

    // Optional: check if order is paid
    public function isPaid()
    {
        return $this->status === 'paid';
    }
}
