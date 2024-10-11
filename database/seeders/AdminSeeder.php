<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'phone_number' => '1234567890',
            'password' => bcrypt('admin_password'),
            'location' => json_encode(['city' => 'Admin City', 'country' => 'Admin Country']),
            'gender' => 'male',
            'phone_number_verified' => true,
        ]);
    }
}
