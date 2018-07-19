<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name' => 'tanya', 'email' => 'tanya@gmail.com', 'password' => bcrypt('user'), 'role_id' => 3]);
        DB::table('users')->insert(['name' => 'dima', 'email' => 'dima@gmail.com', 'password' => bcrypt('user'), 'role_id' => 3]);
        DB::table('users')->insert(['name' => 'andrey', 'email' => 'andrey@gmail.com', 'password' => bcrypt('user'), 'role_id' => 3]);
        DB::table('users')->insert(['name' => 'vasya', 'email' => 'vasya@gmail.com', 'password' => bcrypt('manager'), 'role_id' => 2]);
        DB::table('users')->insert(['name' => 'alex', 'email' => 'alex@gmail.com', 'password' => bcrypt('manager'), 'role_id' => 2]);
        DB::table('users')->insert(['name' => 'dima', 'email' => 'dmitriy@gmail.com', 'password' => bcrypt('admin'), 'role_id' => 1]);
    }
}
