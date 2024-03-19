<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert(
            [
                'name'=>"Product A",
                'price'=>'200',
                'description'=> 'dummy description',
                'category'=>'Category A',
                'gallery' => 'test'
            ]
        );
    }
}

// php artisan db:seed --class ProductSeeder