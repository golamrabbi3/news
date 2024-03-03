<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comments = [
            [
                'detail' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet.',
                'user_id' => 1,
                'news_id' => 1,
            ],
            [
                'detail' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.',
                'user_id' => 2,
                'news_id' => 2,
            ],
            [
                'detail' => 'Vivamus commodo velit at mi volutpat, sit amet lacinia eros varius. In hac habitasse platea dictumst.',
                'user_id' => 3,
                'news_id' => 3,
            ],
            [
                'detail' => 'Fusce eget mi a ligula laoreet accumsan at in leo. Ut facilisis urna nec orci tristique, vel tempus mauris feugiat.',
                'user_id' => 1,
                'news_id' => 1,
            ],
            [
                'detail' => 'Nulla facilisi. Proin vel velit sit amet odio ultrices suscipit eu a leo.',
                'user_id' => 2,
                'news_id' => 2,
            ],
            [
                'detail' => 'Duis in urna nec libero tincidunt sodales id non ex. Sed non urna auctor, consectetur risus sit amet, posuere metus.',
                'user_id' => 3,
                'news_id' => 3,
            ],
            [
                'detail' => 'Quisque et justo id odio volutpat laoreet eget sit amet libero. Integer bibendum, urna a dapibus bibendum.',
                'user_id' => 1,
                'news_id' => 1,
            ],
            [
                'detail' => 'Curabitur ultrices mi ac magna varius, id varius sem blandit. Sed bibendum nunc at sem auctor, ut volutpat justo accumsan.',
                'user_id' => 2,
                'news_id' => 2,
            ],
            [
                'detail' => 'Nam eu elit ac ante fermentum imperdiet nec eget tortor. Sed hendrerit metus id urna tincidunt, vitae consectetur nisl efficitur.',
                'user_id' => 3,
                'news_id' => 3,
            ],
            [
                'detail' => 'Integer tristique justo nec turpis consectetur, sit amet cursus dui gravida. In in purus auctor, congue nisi ut, scelerisque purus.',
                'user_id' => 1,
                'news_id' => 1,
            ],
        ];

        Comment::insert($comments);
    }
}
