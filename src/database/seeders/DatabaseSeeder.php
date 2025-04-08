<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $user = User::first(); // 適当なユーザーを取得
        $product = Product::first(); // 適当な商品を取得
    
        if ($user && $product) {
            Comment::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'content' => 'この商品、めっちゃいいですね！'
            ]);
        }
        $this->call(CategorySeeder::class);
    }
}
