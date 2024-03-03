<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RolesUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $userRoles = [];
        foreach ($users as $user){
            $userRole[] = [
                'role_id'=>$user->id==1?1:2,
                'user_id'=>$user->id
            ];
        };

        DB::table('role_user')->insert($userRoles);
    }
}
