<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id', 'user_name', 'building', 'phone_number', 'address', 'profile_image',
    ];
    
    public function user()
    {
    return $this->belongsTo(User::class);
    }
}
