<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now(); // Get the current timestamp
        $categories = [
            ['name' => 'Apartments', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Offices', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Properties', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Clinincs', 'created_at' => $now, 'updated_at' => $now]
        ];

        // Using insert to seed multiple categories at once
        Category::insert($categories);
    }
}
