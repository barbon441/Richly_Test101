<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::inRandomOrder()->first();
        if (!$user) return;

        Report::create([
            'summary' => 'รายงานประจำเดือน',
            'user_id' => $user->id,
        ]);
    }
}

