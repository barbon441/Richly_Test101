<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();
        if (!$category || !$user) return;

        Transaction::create([
            'amount' => 100,
            'user_id' => $user->id,
            'category_id' => $category->id,
        ]);
    }
}

