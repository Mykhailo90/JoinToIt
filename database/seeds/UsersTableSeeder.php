<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the databese seeds
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();

        create('App\User', [
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
        ]);
    }
}
