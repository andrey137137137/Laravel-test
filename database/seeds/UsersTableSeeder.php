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
        DB::table('users')->insert(['name' => 'Василий Петрович', 'email' => 'vasya@mail.com', 'password' => bcrypt('manager'), 'role_id' => 2]);
    }
}
