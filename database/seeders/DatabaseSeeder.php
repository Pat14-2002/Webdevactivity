<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
       
        
         User::factory(100)->create([
        User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('test_password'),
        ])
    ]);
    }
}
