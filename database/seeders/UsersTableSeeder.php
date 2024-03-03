<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create([
            'first_name' => "Super",
            'last_name' => "Admin",
            'email' => "superadmin@gmail.com",
            'phone' => "001112223333",
            'country_id' => 1,
            'password' => Hash::make('superadmin'),
            'remember_token' => Str::random(10),
        ]);

        User::factory()->count(10)->create();
    }
}
