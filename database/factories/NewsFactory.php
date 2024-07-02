<?php

namespace Database\Factories;

use App\Helpers\NewsStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->paragraphs(nb: 10, asText: true),
            'status' => NewsStatus::Published,
            'user_id' => 1,
        ];
    }
}
