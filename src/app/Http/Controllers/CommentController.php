<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    // public function store(Request $request) {
        public function store(CommentRequest $request, Product $product)
    {

        Comment::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'content' => $request->content
        ]);

        return redirect()->route('product.detail', $productId)->with('success', 'コメントを投稿しました！');
    }
}
    

