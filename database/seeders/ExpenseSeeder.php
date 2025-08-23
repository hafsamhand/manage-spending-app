<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Expense;
use App\Models\User;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            Expense::factory()->count(10)->create(['user_id' => $user->id]);
        }
    }
}
