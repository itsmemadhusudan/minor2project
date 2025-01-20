<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentSuccessful extends Model
{
    use HasFactory;

    protected $table = 'payment_successful'; // Table name (if different from the default plural form)

    protected $fillable = [
        'payment_id',
        'status',
        'amount',
        'reference_id',
    ];
}
