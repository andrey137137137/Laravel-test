<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(['name' => 'admin', 'edit_user' => 1, 'edit_application' => 1]);
        DB::table('roles')->insert(['name' => 'manager', 'edit_application' => 1]);
        DB::table('roles')->insert(['name' => 'user']);
    }
}
