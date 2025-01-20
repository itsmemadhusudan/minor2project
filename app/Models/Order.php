<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Models\Cart;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'cart_ids',
        'order_id',
        'payment_type',
        'payment_status',
    ];
    protected $casts = [
        'cart_ids' => 'array', // Automatically casts JSON to an array
    ];

    public function getCartsAttribute(): Collection
    {
        return $this->cart_ids ? Cart::with('product')->whereIn('id', $this->cart_ids)->get() : collect();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    // Define relationships if necessary
}