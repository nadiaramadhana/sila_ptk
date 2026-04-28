<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(["name"=> "manage users"]);
        Permission::create(["name"=> "manage data"]);
        Permission::create(["name"=> "manage data sekolah"]);
        Permission::create(["name"=> "manage pengajuan"]);
        Permission::create(["name"=> "manage validation"]);

        $admin = Role::create (["name"=> "admin"]);
        $operator_sekolah = Role::create(["name"=> "operator_sekolah"]);

        $admin->givePermissionTo(Permission::all());
        $operator_sekolah->givePermissionTo([
            "manage data sekolah",
            "manage pengajuan",
            "manage data",
        ]);
    }
}
