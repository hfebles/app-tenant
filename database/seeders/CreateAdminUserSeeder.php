<?php

namespace Database\Seeders;

use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => '1@1.com',
            'password' => bcrypt('123')
        ]);

        $role = Role::create(['name' => 'Admin']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);




        Tenant::all()->runForEach(
            function () {
                $user = User::create([
                    'name' => 'Admin',
                    'email' => '2@1.com',
                    'password' => bcrypt('123')
                ]);

                $role = Role::create(['name' => 'Admin']);

                $permissions = Permission::pluck('id', 'id')->all();

                $role->syncPermissions($permissions);

                $user->assignRole([$role->id]);
            }
        );
    }
}
