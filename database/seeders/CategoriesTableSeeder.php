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
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Sport',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Business',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Innovation',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Culture',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Travel',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'World',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Entertainment',
                'is_active' => true,
                'category_id' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Gaza-Israel War',
                'is_active' => true,
                'category_id' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => 'Russia-Ukraine War',
                'is_active' => true,
                'category_id' => 7,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
