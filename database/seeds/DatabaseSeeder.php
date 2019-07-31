<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin')->insert([
            'name' => str_random(20),
            'password' => bcrypt('secret'),
            'email' => str_random(10).'@gmail.com',
            'avatar' => 'avatar_20180612015940.jpg',
            'provider' => '',
            'provider_id' => 1,
            'role_type' => 1,
            'ins_id' => 1,
            'upd_id' => NULL,
            'del_flag' => 0
        ]);
    }
}
