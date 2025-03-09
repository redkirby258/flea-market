<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id(); // ログインユーザーのID取得（未ログインならnull）
        
        $products = Product::where('user_id', '!=', $userId) // 自分の商品を除外
            ->with('image') // 商品画像を取得
            ->get();

        return view('index', compact('products'));
    }
}
