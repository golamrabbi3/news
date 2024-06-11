<?php

namespace Database\Seeders;
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
            ->hasComments(3)
            ->hasTags(3)
            ->create()
            ->each(function ($news) {
                $news->featuredImage()->create([
                    'path' => fake()->imageUrl(),
                    'is_featured' => true,
                ]);

                DB::table('categorizables')->insert([
                    'category_id' => rand(1, 10),
                    'categorizable_id' => $news->id,
                    'categorizable_type' => get_class($news),
                ]);
            });
    }
}
