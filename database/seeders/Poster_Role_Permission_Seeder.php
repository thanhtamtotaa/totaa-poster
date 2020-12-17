<?php

namespace Totaa\TotaaPoster\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Poster_Role_Permission_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Permission::where("name", "view-poster")->count() == 0) {
            $permission[] = Permission::create(['name' => 'view-poster', "description" => "Xem Poster", "group" => "Poster", "order" => 1, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "view-poster")->first();
        }

        if (Permission::where("name", "add-poster")->count() == 0) {
            $permission[] = Permission::create(['name' => 'add-poster', "description" => "Thêm Poster", "group" => "Poster", "order" => 2, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "add-poster")->first();
        }

        if (Permission::where("name", "edit-poster")->count() == 0) {
            $permission[] = Permission::create(['name' => 'edit-poster', "description" => "Sửa Poster", "group" => "Poster", "order" => 3, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "edit-poster")->first();
        }

        if (Permission::where("name", "delete-poster")->count() == 0) {
            $permission[] = Permission::create(['name' => 'delete-poster', "description" => "Xóa Poster", "group" => "Poster", "order" => 4, "lock" => true,]);
        } else {
            $permission[] = Permission::where("name", "delete-poster")->first();
        }

        if (Role::where("name", "super-admin")->count() == 0) {
            $super_admin =  Role::create(['name' => 'super-admin', "description" => "Super Admin", "group" => "Admin", "order" => 1, "lock" => true,]);
        } else {
            $super_admin= Role::where("name", "super-admin")->first();
        }

        if (Role::where("name", "admin")->count() == 0) {
            $admin = Role::create(['name' => 'admin', "description" => "Admin", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin = Role::where("name", "admin")->first();
        }

        if (Role::where("name", "admin-poster")->count() == 0) {
            $admin_poster = Role::create(['name' => 'admin-poster', "description" => "Admin Quản lý Poster", "group" => "Admin", "order" => 2, "lock" => true,]);
        } else {
            $admin_poster = Role::where("name", "admin-poster")->first();
        }

        $super_admin->givePermissionTo($permission);
        $admin->givePermissionTo($permission);
        $admin_poster->givePermissionTo($permission);
    }
}
