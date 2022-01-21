<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'Asad',
                'role_id' => '1',
                'email' => 'asad@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Uzair',
                'role_id' => '1',
                'email' => 'uk5598060@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Bilal',
                'role_id' => '2',
                'email' => 'bilal@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Basit',
                'role_id' => '2',
                'email' => 'basit@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Naveed',
                'role_id' => '2',
                'email' => 'naveed@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Zaid',
                'role_id' => '2',
                'email' => 'zaid@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Adeel',
                'role_id' => '2',
                'email' => 'adeel@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'remember_token' => Str::random(10),
                'created_at' => date("Y-m-d H:i:s"), 
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
