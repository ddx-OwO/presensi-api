<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 10)->create();
        DB::table('users')->insert([
            'username' => 'admin',
            'name' => 'Administrator',
            'email' => Str::random(10).'@gmail.com',
            'password' => password_hash('admin', PASSWORD_BCRYPT)
        ]);
    }
}
