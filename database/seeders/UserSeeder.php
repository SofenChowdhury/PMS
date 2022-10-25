<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('password'),
            'phone' => '01700718852',
        ]);
        for($i=0; $i<8; $i++){
            DB::table('users')->insert([
                'name' => Str::random(1).'_user',
                'email' => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'phone' => mt_rand(10000000000, 99999999999),
            ]);
        }
    }
}
