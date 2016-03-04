<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        App\User::create(array(
            'name' => 'Bruce Wayne',
            'email'=> 'bruce@wayneenterprises.com',
            'password' => bcrypt('batman'),
        ));
    }
}
