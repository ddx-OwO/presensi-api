<?php

use App\User;
use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            [
                'name' => 'administrator',
                'description' => 'admin'
            ],
            [
                'name' => 'guru',
                'description' => 'Guru'
            ],
            [
                'name' => 'siswa',
                'description' => 'siswa'
            ]
        ]);

        // Get all the roles attaching up to 3 roles to each user
        $roles = App\Role::all();

        // Populate the pivot table
        App\User::all()->each(function ($user) use ($roles) { 
            $user->roles()->saveMany($roles);
        });
    }
}
