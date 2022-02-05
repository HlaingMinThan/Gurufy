<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert(
            [
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'username' => 'superadmin',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('111111'),
                'type' => 1
            ]
        );
        DB::table('admins')->insert(
            [
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'username' => 'admin',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('111111'),
                'type' => 2
            ]
        );
    }
}
