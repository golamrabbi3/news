<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\News;

class NewsTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newsData = News::all();
        $newsTag = [];
        foreach ($newsData as $news){
            $newsTag[] = [
                'news_id'=>$news->id,
                'tag_id'=>$news->id
            ];
        };

        DB::table('news_tag')->insert($newsTag);
    }
}
