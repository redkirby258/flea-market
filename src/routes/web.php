<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;

// ===========================
// 認証
// ===========================
Route::get('/register', [UserController::class, 'showRegistrationForm']);
Route::post('/register', [UserController::class, 'storeUser']);
Route::post('/login', [UserController::class, 'loginUser']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');

// ===========================
// 商品一覧（トップ）
// ===========================
Route::get('/', [ItemController::class, 'index'])->name('products.index');
Route::get('/?page=mylist', [ItemController::class, 'mylist'])->name('products.mylist');

// ===========================
// 商品詳細・購入
// ===========================
Route::get('/item/{item_id}', [ItemController::class, 'detail'])->name('products.detail');
Route::get('/purchase/{item_id}', [ItemController::class, 'show'])->name('purchase.show');
Route::post('/products/{item_id}/purchase', [ItemController::class, 'purchase'])->name('products.purchase');
Route::get('/purchase/address/{item_id}', [ItemController::class, 'changeAddress'])->name('purchase.address');

// ===========================
// 商品出品
// ===========================
Route::get('/sell', [ItemController::class, 'create'])->name('products.create');
Route::post('/sell/store', [ItemController::class, 'store'])->name('products.store');

// ===========================
// プロフィール（マイページ）
// ===========================
Route::get('/mypage', [UserController::class, 'showProfile'])->name('mypage');
Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::post('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');

// ===========================
// いいね / コメント
// ===========================
Route::post('/like/{product}', [LikeController::class, 'toggleLike'])->name('like.toggle');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store');

Route::get('/profile/setup', [ProfileController::class, 'setup'])->name('profile.setup');
Route::post('/profile/setup', [ProfileController::class, 'store'])->name('profile.store');

