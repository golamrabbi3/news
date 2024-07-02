<?php

namespace Database\Seeders;

use App\Helpers\Roles;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Artisan::call('permission:create');
        $now = now();
        $guardName = config('auth.defaults.guard');

        Role::insert([
            [
                'name' => Roles::Admin,
                'guard_name' => $guardName,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => Roles::Moderator,
                'guard_name' => $guardName,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => Roles::Author,
                'guard_name' => $guardName,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => Roles::Viewer,
                'guard_name' => $guardName,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $permissions = Permission::pluck('id', 'id')->all();
        $adminRole = Role::where('name', Roles::Admin)->first();
        $adminRole->syncPermissions($permissions);
    }
}
