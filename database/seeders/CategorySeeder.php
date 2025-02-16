<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $user = User::inRandomOrder()->first();
        if (!$user) return;

        if (Category::count() == 0) {
            Category::create(['name' => 'อาหาร', 'user_id' => $user->id]);
            Category::create(['name' => 'เดินทาง', 'user_id' => $user->id]);
            Category::create(['name' => 'บันเทิง', 'user_id' => $user->id]);
        }
    }
}

