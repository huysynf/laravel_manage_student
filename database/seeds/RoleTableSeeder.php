<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['name' => 'view permission', 'slug' => 'view-permission',],
            ['name' => 'create permission', 'slug' => 'create-permission',],
            ['name' => 'edit permission','slug' => 'edit-permission', ],
            ['name' => 'update permission', 'slug' => 'update-permission'],
            ['name' => 'delete permission', 'slug' => 'delete-permission',],

            ['name' => 'view role','slug' => 'view-role',],
            ['name' => 'create role','slug' => 'create-role',],
            ['name' => 'edit role','slug' => 'edit-role',],
            ['name' => 'update role','slug' => 'update-role',],
            ['name' => 'delete role','slug' => 'delete-role',],

            ['name' => 'view user','slug' => 'view-user',],
            ['name' => 'create user','slug' => 'create-user',],
            ['name' => 'edit user','slug' => 'edit-user',],
            ['name' => 'update user','slug' => 'update-user',],
            ['name' => 'delete user','slug' => 'delete-user',],

            ['name' => 'view student','slug' => 'view-student',],
            ['name' => 'create student','slug' => 'create-student',],
            ['name' => 'edit student','slug' => 'edit-student',],
            ['name' => 'update student','slug' => 'update-student',],
            ['name' => 'delete student','slug' => 'delete-student',],

            ['name' => 'view classroom','slug' => 'view-classroom',],
            ['name' => 'create classroom','slug' => 'create-classroom',],
            ['name' => 'edit classroom','slug' => 'edit-classroom',],
            ['name' => 'update classroom','slug' => 'update-classroom',],
            ['name' => 'delete classroom','slug' => 'delete-classroom',],

            ['name' => 'view subject','slug' => 'view-subject',],
            ['name' => 'create subject','slug' => 'create-subject',],
            ['name' => 'edit subject','slug' => 'edit-subject',],
            ['name' => 'update subject','slug' => 'update-subject',],
            ['name' => 'delete subject','slug' => 'delete-subject',],

            ['name' => 'view faculty','slug' => 'view-faculty',],
            ['name' => 'create faculty','slug' => 'create-faculty',],
            ['name' => 'edit faculty','slug' => 'edit-faculty',],
            ['name' => 'update faculty','slug' => 'update-faculty',],
            ['name' => 'delete faculty','slug' => 'delete-faculty',],
        ]);
        DB::table('roles')->insert([
            ['name'=>'super admin','slug'=>'super-admin'],
        ]);
        DB::table('role_user')->insert([
            ['user_id'=>1,'role_id'=>1],
        ]);
        for($i=1;$i<29;$i++){
            DB::table('role_permission')->insert([
                ['role_id'=>1,'permission_id'=>$i],
            ]);
        }

    }
}
