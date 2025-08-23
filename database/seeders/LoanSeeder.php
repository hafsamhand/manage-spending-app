<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Loan;
use App\Models\User;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if ($user) {
            Loan::factory()->count(5)->create(['user_id' => $user->id]);
        }
    }
}
