<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => "Super",
            'last_name' => "Admin",
            'email' => "superadmin@codemen.org",
            'password' => 'P@ssw0rd',
            'email_verified_at' => now(),
            'is_super_admin' => true,
        ]);

        $user->avatar()->create([
            'path' => 'https://i.pravatar.cc/150?img=1',
        ]);

        User::factory()
            ->count(4)
            ->create()->each(function ($user) {
                $user->avatar()->create([
                    'path' => "https://i.pravatar.cc/150?img={$user->id}",
                ]);

                $user->assignRole(random_int(1, 4));
            });
    }
}
