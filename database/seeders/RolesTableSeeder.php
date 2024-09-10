<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // Tạo các vai trò (roles)
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'agency']);
        Role::create(['name' => 'tourism_department']);
        Role::create(['name' => 'user']);
    }
}
