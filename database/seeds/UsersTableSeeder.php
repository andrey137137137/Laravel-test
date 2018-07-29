<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(['name' => 'Василий Петрович', 'email' => 'vasya@mail.com', 'password' => bcrypt('manager'), 'role_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
    }
}
