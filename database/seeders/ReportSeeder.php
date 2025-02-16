<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReportSeeder extends Seeder {
    public function run() {
        DB::table('reports')->insert([
            ['reports_type' => 'monthly', 'total_income' => 500.00, 'total_expense' => 100.00, 'reported_date' => '2024-02-28', 'user_id' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

