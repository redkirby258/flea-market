<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\Profile;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    public function index(Request $request)
{
    $page = $request->query('page'); // クエリパラメータを取得

    if ($page === 'mylist') {
        return $this->mylist($request); // マイリスト表示
    }

    // 全商品を取得（自分が出品した商品は除外）
    $query = Product::query();

    // 商品名の部分一致検索
    if ($request->has('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
    }

    // ログインユーザーの場合、マイリスト機能の状態を考慮
    if ($request->page === 'mylist' && Auth::check()) {
        $query->whereHas('likes', function ($q) {
            $q->where('user_id', Auth::id());
        });
    }

    if (auth()->check()) {
        $query->where('user_id', '!=', auth()->id()); // 自分が出品した商品を除外
    }

    $products = $query->paginate(10); // 商品画像を取得し、ページネーション

    // ビューに渡す変数は$productsのみ
    return view('products.index', compact('products', 'request'));
}

/**
 * いいねした商品一覧を取得（マイリスト）
 */
public function mylist(Request $request)
{
    // 未認証ユーザーには何も表示しない
    if (!auth()->check()) {
        return redirect()->route('products.index');
    }

    $user = auth()->user();
    $mylist = $user->likedProducts()->paginate(10); // いいねした商品を取得し、ページネーション

    return view('products.index', compact('mylist')); // mylistをビューに渡す
}


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
            'name' => 'required|string|max:255',
            'brand' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|integer|min:0',
            'condition' => 'required|string',
            'category' => 'required|string',
        ]);

        $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

        Product::create([
            'user_id' => Auth::id(),
            'image' => $imagePath,
            'name' => $request->name,
            'brand' => $request->brand,
            'description' => $request->description,
            'price' => $request->price,
            'condition' => $request->condition,
            'category' => $request->category,
        ]);

        return redirect()->route('products.index')->with('success', '商品を出品しました！');
    }

    public function create()
    {
        $categories = Category::all(); // カテゴリ一覧を取得
        return view('products.create', compact('categories'));
    }

    public function create_store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:1',
            'condition' => 'required|string',
            'categories' => 'required|array',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->condition = $request->condition;
        $product->user_id = Auth::user()->id;
        $product->save();

        // 中間テーブルにカテゴリを保存（多対多の場合）
        $product->categories()->attach($request->categories);

        return redirect()->route('products.create')->with('success', '商品を出品しました');
    }

    public function detail($id)
    {
    $product = Product::with(['categories', 'comments.user', 'likes'])
                      ->findOrFail($id);

    if (!$product) {
                    abort(404, '商品が見つかりません');
                }

    return view('products.detail', compact('product'));
    }

    public function show($id)
    {
        // 指定されたIDの商品を取得
        $product = Product::findOrFail($id);
        $user = Auth::user();

        // ユーザーの住所情報を取得（なければ空文字）
        $address = $user->address ?? '';

        return view('products.purchase', compact('product', 'address'));;
    }

    /**
     * 購入処理を実行
     */
    public function purchase(Request $request, $id)
{
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', '購入にはログインが必要です。');
    }

    $product = Product::findOrFail($id);

    if ($product->sold) {
        return redirect()->route('products.detail', $id)->with('error', 'この商品はすでに売却済みです。');
    }

    $paymentMethod = $request->input('payment');

    if ($paymentMethod === 'credit') {
        // Stripe決済のセットアップ
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => ['name' => $product->name],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('products.payment.success', ['id' => $product->id]),
            'cancel_url' => route('products.detail', ['id' => $product->id]),
        ]);

        return redirect($session->url);
    } else {
        // コンビニ支払い処理（仮）
        Order::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'price' => $product->price,
            'payment_method' => 'convenience',
        ]);

        $product->update(['sold' => true]);

        return redirect()->route('products.index')->with('success', 'コンビニ払いで購入しました！');
    }
}
}
