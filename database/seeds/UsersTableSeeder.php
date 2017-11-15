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
        DB::table('users')->insert([
            'name' => str_random('KommaBoarder'),
            'email' => 'kommaboarder@gmail.com',
            'password' => bcrypt('verysecretpassword'),
        ]);
    }
}
