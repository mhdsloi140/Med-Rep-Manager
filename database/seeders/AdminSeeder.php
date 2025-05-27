<?php

namespace Database\Seeders;

use App\Enums\UserableEnum;
use App\Enums\UserableIdEnum;
use App\Enums\UserableTypeEnum;
use App\Models\Admin;
use App\Models\SuperAdmin;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $user=  User::create([
            'name' => 'Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'userable_type' => UserableEnum::Admin->value,
            'userable_id'=>1,
            'roles_name'=>['owner'],
            'status'=>'active'


        ]);
        Admin::create([
            'name'=>'admin',
            'phone'=>'0930641701'
        ]);
        $role=Role::create(['name'=>'owner']);
        $permissions=Permission::pluck('id','id')->all();
        $role->syncPermissions($permissions);
        $user->assignRole($role->id);
     }
}
