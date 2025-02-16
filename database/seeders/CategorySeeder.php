<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder {
    public function run() {
        DB::table('categories')->insert([
            ['name' => 'Salary', 'type' => 'income', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Food', 'type' => 'expense', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

