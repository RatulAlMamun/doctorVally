<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'doctor', 'guard_name' => 'api']);
        Role::firstOrCreate(['name' => 'chamber', 'guard_name' => 'api']);
    }
}
