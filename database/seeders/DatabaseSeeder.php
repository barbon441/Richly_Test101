<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class, // ✅ สร้าง Users ก่อน
            CategorySeeder::class, // ✅ สร้าง Categories ต่อ
            BudgetSeeder::class, // ✅ Budget ใช้ Category และ User ที่มีอยู่
            TransactionSeeder::class, // ✅ Transaction อ้างอิง Budget และ User
            ReportSeeder::class, // ✅ Report ใช้ User ที่มีอยู่
        ]);
    }
}

