<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role = [
            [
                'name'=>'Super Admin',
                'slug' => 'superadmin'
            ],
            [
                'name'=>'User',
                'slug' => 'user'
            ],
        ];

        Role::insert($role);
    }
}
