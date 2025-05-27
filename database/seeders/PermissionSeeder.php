<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $permissions=[
            'create_visti',
            'create_delegate',

            'create_supervisor',
            'create_doctor',
            'create_sample',
            'create_company',
            'create_region',
            'create_city',
            'create_ticket',
            'create_permission',

            'create_comment',
            'view_comment',
            'update_comment',
            'delete_comment',


            'create_role',
            'update_role',
            'delete_role',
            'view_role',

            'update_doctor',
            'update_sample',
            'update_company',
            'update_region',
            'update_city',
            'update_visti',
            'update_permission',






            'delete_visti',
            'delete_delegate',
            'delete_supervisor',
            'delete_doctor',
            'delete_sample',
            'delete_company',
            'delete_region',
            'delete_city',
            'delete_ticket',
            'delete_permission',


            'view_visti',
            'view_delegate',
            'view_permission',
            'view_supervisor',
            'view_doctor',
            'view_sample',
            'view_company',
            'view_region',
            'view_city',
            'view_users',
            'view_ticket'

         ];

         foreach($permissions as $permission)
         {
            Permission::create([
                'name'=>$permission
            ]);
         }
    }
}
