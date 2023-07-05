<?php

namespace Database\Seeders;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'full_name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'status' => 'active'
            ],
            // Vendor
            [
                'full_name' => 'Vendor',
                'username' => 'vendor',
                'email' => 'vendor@gmail.com',
                'password' => Hash::make('vendor'),
                'role' => 'vendor',
                'status' => 'active'
            ],

            // Customer
            [
                'full_name' => 'Customer',
                'username' => 'customer',
                'email' => 'customer@gmail.com',
                'password' => Hash::make('customer'),
                'role' => 'customer',
                'status' => 'active',
            ]
        ]);
    }
}
