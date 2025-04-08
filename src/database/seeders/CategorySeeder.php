<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'ファッション', '家電', '家具', '本・音楽・ゲーム', 'おもちゃ・ホビー', 
            'コスメ・美容', 'スポーツ・レジャー', 'ハンドメイド', '食品・飲料',
            'その他'
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    }
}
