<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
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
        User::factory(10)->create();
    }
}
