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

        factory(User::class)->create();
    }
}
