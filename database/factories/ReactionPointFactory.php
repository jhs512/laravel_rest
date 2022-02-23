<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ReactionPointFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $userId = 1;

        $articleId = $userId;

        if ($userId > 10) {
            echo '현재 팩토리룰에서는 ReactionPointFactory에서 10개 이상의 데이터를 만들어내면 안됩니다.';
            exit;
        }

        return [
            'user_id' => $userId++,
            'point' => 1,
            'reaction_pointable_type' => 'App\Models\Article',
            'reaction_pointable_id' => $articleId,
        ];
    }
}
