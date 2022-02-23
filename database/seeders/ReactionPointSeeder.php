<?php

namespace Database\Seeders;

use App\Models\ReactionPoint;
use Illuminate\Database\Seeder;

class ReactionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ReactionPoint::factory(10)->create();
    }
}
