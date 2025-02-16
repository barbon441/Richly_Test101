<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class BudgetSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        if (!$category || !$user) return;

        Budget::create([
            'amount' => 5000,
            'user_id' => User::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'start_date' => Carbon::now()->subDays(30), // ✅ ใช้วันที่ย้อนหลัง 30 วัน
            'end_date' => Carbon::now(), // ✅ ใช้วันที่ปัจจุบัน
        ]);
    }
}
