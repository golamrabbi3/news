<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsData = [
            [
                'title' => 'Laravel 9 Released',
                'description' => 'The latest version of Laravel, version 9, has been officially released.',
                'user_id' => 1,
            ],
            [
                'title' => 'Tech Company Acquires Startup',
                'description' => 'A major tech company has acquired a promising startup for a billion dollars.',
                'user_id' => 2,
            ],
            [
                'title' => 'New Study on Artificial Intelligence',
                'description' => 'A groundbreaking study reveals new insights into the field of artificial intelligence.',
                'user_id' => 3,
            ],
            [
                'title' => 'Global Climate Agreement Signed',
                'description' => 'Countries around the world come together to sign a historic global climate agreement.',
                'user_id' => 1,
            ],
            [
                'title' => 'Space Exploration Milestone',
                'description' => 'Scientists achieve a significant milestone in space exploration with the successful launch of a new mission.',
                'user_id' => 2,
            ],
            [
                'title' => 'Economic Outlook for the Year',
                'description' => 'Financial experts provide insights into the economic outlook for the coming year.',
                'user_id' => 3,
            ],
            [
                'title' => 'New Health Discovery',
                'description' => 'Researchers announce a breakthrough discovery in the field of health and medicine.',
                'user_id' => 1,
            ],
            [
                'title' => 'Cultural Event Draws International Attention',
                'description' => 'A cultural event attracts attention from around the world, showcasing diversity and creativity.',
                'user_id' => 2,
            ],
            [
                'title' => 'Technology Conference Highlights Innovations',
                'description' => 'The annual technology conference highlights the latest innovations and trends in the tech industry.',
                'user_id' => 3,
            ],
            [
                'title' => 'Educational Initiative Launched',
                'description' => 'A new educational initiative is launched to improve access to quality education for all.',
                'user_id' => 1,
            ],
        ];

        News::insert($newsData);
    }
}
