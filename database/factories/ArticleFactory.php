<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $userId = 1;

        if ($userId > 10) {
            echo '현재 팩토리룰에서는 ArticleFactory에서 10개 이상의 데이터를 만들어내면 안됩니다.';
            exit;
        }

        return [
            'user_id' => $userId++,
            'title' => $this->faker->sentence(),
            'body' => $this->faker->text(200),
            'good_reaction_point' => 1,
        ];
    }
}
