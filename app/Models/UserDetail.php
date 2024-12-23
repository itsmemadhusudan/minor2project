<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'email',
    ];

    // Define the relationship if needed
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
