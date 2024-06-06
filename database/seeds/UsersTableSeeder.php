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
            ['username' => 'Atlas一郎',
            'mail' => '1@jp',
            'password' => bcrypt('1')],
            ['username' => 'Atlas二郎',
            'mail' => '2@jp',
            'password' => bcrypt('2')],
            ['username' => 'Atlas三郎',
            'mail' => '3@jp',
            'password' => bcrypt('3')],
            ['username' => 'Atlas四郎',
            'mail' => '4@jp',
            'password' => bcrypt('4')],
            ['username' => 'Atlas五郎',
            'mail' => '5@jp',
            'password' => bcrypt('5')]
        ]);
        //
    }
}
