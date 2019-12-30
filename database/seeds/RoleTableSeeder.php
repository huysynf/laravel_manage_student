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

            ['name' => 'Xem quyền', 'slug' => 'view-permission',],
            ['name' => 'Tạo mới quyền', 'slug' => 'create-permission',],
            ['name' => 'Sửa quyền','slug' => 'edit-permission', ],
            ['name' => 'Cập nhật quyền', 'slug' => 'update-permission'],
            ['name' => 'Xóa quyền', 'slug' => 'delete-permission',],

            ['name' => 'Xem Nhóm quyền','slug' => 'view-role',],
            ['name' => 'Th Nhóm quyền','slug' => 'create-role',],
            ['name' => 'Tạo Nhóm quyền','slug' => 'edit-role',],
            ['name' => 'Cập nhật Nhóm quyền','slug' => 'update-role',],
            ['name' => 'xóa Nhóm quyền','slug' => 'delete-role',],

            ['name' => 'Xem người dùng','slug' => 'view-user',],
            ['name' => 'Tạo mới người dùng','slug' => 'create-user',],
            ['name' => 'Sửa người dùng','slug' => 'edit-user',],
            ['name' => 'Cập nhật người dùng','slug' => 'update-user',],
            ['name' => 'Xóa người dùng','slug' => 'delete-user',],

            ['name' => 'Xem danh sách sinh viên','slug' => 'view-student',],
            ['name' => 'Thêm  sinh viên','slug' => 'create-student',],
            ['name' => 'Sửa sinh viên','slug' => 'edit-student',],
            ['name' => 'Cập nhật sinh viên','slug' => 'update-student',],
            ['name' => 'Xóa sinh viên','slug' => 'delete-student',],

            ['name' => 'Xem danh sách lớp học','slug' => 'view-classroom',],
            ['name' => 'Thêm lớp học','slug' => 'create-classroom',],
            ['name' => 'Sửa lớp học','slug' => 'edit-classroom',],
            ['name' => 'Cập nhật lớp học','slug' => 'update-classroom',],
            ['name' => 'Xóa lớp học','slug' => 'delete-classroom',],

            ['name' => 'Xem danh sách môn học','slug' => 'view-subject',],
            ['name' => 'Tạo  môn học','slug' => 'create-subject',],
            ['name' => 'Sửa môn học','slug' => 'edit-subject',],
            ['name' => 'Cập nhật môn học','slug' => 'update-subject',],
            ['name' => 'Xóa môn học','slug' => 'delete-subject',],

            ['name' => 'Xem danh sách Khoa','slug' => 'view-faculty',],
            ['name' => 'Tạo mới Khoa','slug' => 'create-faculty',],
            ['name' => 'sửa Khoa','slug' => 'edit-faculty',],
            ['name' => 'Cập nhật Khoa','slug' => 'update-faculty',],
            ['name' => 'Xóa Khoa','slug' => 'delete-faculty',],
        ]);
        DB::table('roles')->insert([
            ['name'=>'Super admin','slug'=>'SUPER ADMIN'],
            ['name'=>'admin','slug'=>'ADMIN'],
            ['name'=>'Nhân viên','slug'=>'EMPLOYEE'],
            ['name'=>'Nguời dùng','slug'=>'USER']
            ,
        ]);
        for($i=1;$i<36;$i++){
            DB::table('role_permission')->insert([
                ['role_id'=>1,'permission_id'=>$i],
            ]);
        }

    }
}
