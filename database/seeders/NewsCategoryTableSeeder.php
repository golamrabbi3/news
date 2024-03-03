<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\News;

class NewsCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsData = News::all();
        $newsCategory = [];
        foreach ($newsData as $news){
            $newsCategory[] = [
                'news_id'=>$news->id,
                'category_id'=>$news->id
            ];
        };

        DB::table('news_category')->insert($newsCategory);
    }
}
