<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->users();
    }

    public function users()
    {
//        \DB::table('users')->truncate();

        app(User::class)->create([
            'id' => 'c3292630-b566-11e6-9f57-e767178192e6',
            'fullname' => 'SAdmin',
            'email' => 'admin@gmail.com',
            'password' => 'minaworks',
            'nickname' => 'admin',
            'role' => 1
        ]);

        factory(User::class, 10)->create();
    }
}
