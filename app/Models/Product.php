<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'added_by',
        'category',
        'image', 
    ];

    public function user(){
        return $this->belongsTo(User::class,'added_by');
    }
}