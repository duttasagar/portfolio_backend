<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminLogin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         AdminLogin::create([
            'name' => 'Super Admin',
            'email' => 'duttasagar39@gmail.com',
            'password' => Hash::make('password'),
        ]);
    }
}
