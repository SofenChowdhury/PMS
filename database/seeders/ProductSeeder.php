<?php

namespace Database\Seeders;

use random;
use Faker\Core\Number;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0; $i<10; $i++){
            DB::table('products')->insert([
                'name' => Str::random(1).'-product',
                'sku' => Str::random(10).'@viser.X',
                'price' => mt_rand(1000000, 9999999),
            ]);
        }
    }
}
