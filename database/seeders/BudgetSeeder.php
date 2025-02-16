<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BudgetSeeder extends Seeder {
    public function run() {
        DB::table('budgets')->insert([
            ['amount' => 1000.00,
            'start_date' => '2024-01-01',
            'end_date' => '2024-01-31',
            'user_id' => 1,
            'category_id' => 2,
            'created_at' => now(),
            'updated_at' => now()],
        ]);
    }
}
