<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'first_name' => Str::random(10),
                'last_name' => Str::random(10),
                'email' => 'test@test.com',
                'password' => Hash::make('111111'),
                'is_email_verified' => true,
                'status' => true
            ]
        );
    }
}
