<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        Category::insert([
            [
                'name' => 'Local News',
                'slug' => str('Local News')->slug(),
                'order' => 1,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sport',
                'slug' => str('Sport')->slug(),
                'order' => 2,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Business',
                'slug' => str('Business')->slug(),
                'order' => 3,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Innovation',
                'slug' => str('Innovation')->slug(),
                'order' => 4,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Culture',
                'slug' => str('Culture')->slug(),
                'order' => 5,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Travel',
                'slug' => str('Travel')->slug(),
                'order' => 6,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'World',
                'slug' => str('World')->slug(),
                'order' => 7,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Entertainment',
                'slug' => str('Entertainment')->slug(),
                'order' => 8,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Gaza-Israel War',
                'slug' => str('Gaza-Israel War')->slug(),
                'order' => 9,
                'category_id' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Russia-Ukraine War',
                'slug' => str('Russia-Ukraine War')->slug(),
                'order' => 10,
                'category_id' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
