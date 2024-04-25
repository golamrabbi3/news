<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => random_int(1, 4),
            'news_id' => random_int(1, 20),
            'comment_id' => null,
            'description' => fake()->sentences(asText: true),
            'is_approved' => random_int(0, 1),
        ];
    }
}
