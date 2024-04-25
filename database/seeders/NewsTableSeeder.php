<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::factory()
            ->count(20)
            ->has(Comment::factory()->count(3))
            ->hasTags(3)
            ->create()
            ->each(function ($news) {
                $news->featuredImage()->create([
                    'path' => fake()->imageUrl(),
                    'is_featured' => true,
                ]);
            });

        $categoryNews = [];
        $now = now();
        for ($i = 1; $i <= 20; $i++) {
            $categoryNews[] = [
                'category_id' => random_int(1, 10),
                'news_id' => random_int(1, 20),
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        DB::table('category_news')->insert($categoryNews);
    }
}
