<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 현재로직에서는 10개가 최대입니다.
        // 더 넘으면 데이터가 안맞습니다.
        Article::factory(10)->create();
    }
}
