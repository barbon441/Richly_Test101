<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder {
    public function run() {
        DB::table('transactions')->insert([
            ['amount' => 500.00, 'transaction_type' => 'income', 'description' => 'Freelance work', 'transaction_date' => '2024-02-15', 'user_id' => 1, 'category_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['amount' => 100.00, 'transaction_type' => 'expense', 'description' => 'Dinner', 'transaction_date' => '2024-02-15', 'user_id' => 1, 'category_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

