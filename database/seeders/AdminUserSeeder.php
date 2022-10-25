<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Administrator']);
        $permission = Permission::create(['name' => 'manage products']);
        $permission->assignRole($adminRole);
 
        $adminUser = User::factory()->create([
            'email' => 'md.rabby.mahmud@gmail.com',
            'password' => bcrypt('password'),
            'phone' => '01719272223',
            'name' => 'Admin'
        ]);
        $adminUser->assignRole('Administrator');
    }
}
