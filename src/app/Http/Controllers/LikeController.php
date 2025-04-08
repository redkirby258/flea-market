<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class LikeController extends Controller
{
    // public function toggleLike($productId) {
        public function toggleLike($productId) {
            $user = Auth::user();
            $product = Product::findOrFail($productId);
    
            if ($product->isLikedBy($user)) {
                // いいねを削除
                Like::where('user_id', $user->id)->where('product_id', $productId)->delete();
            } else {
                // いいねを追加
                Like::create([
                    'user_id' => $user->id,
                    'product_id' => $productId,
                ]);
            }
    
            return response()->json([
                'likes_count' => $product->likes()->count(),
                'is_liked' => $product->isLikedBy($user)
            ]);
        }
    }
