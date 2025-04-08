<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'image_path', 'user_id', 'sold', 'description', 'brand', 'price', 'condition', 'status'];

    public function users()
    {
    return $this->belongsToMany(User::class, 'orders', 'product_id', 'user_id');
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function isLikedBy($user) {
        return $this->likes()->where('user_id', $user->id)->exists();
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'product_category');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }
}