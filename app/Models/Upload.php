<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $table = 'upload'; // Specify the table name

    protected $fillable = [
        'designer_name',
        'email',
        'address',
        'description',
        'price',
        'category',
        'profile_picture',
    ];
}
