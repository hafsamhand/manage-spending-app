<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Loan;

class LoanFactory extends Factory
{
    protected $model = Loan::class;

    public function definition()
    {
        return [
            'type' => $this->faker->randomElement(['borrowed','given']),
            'person' => $this->faker->name(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'status' => $this->faker->randomElement(['pending','paid']),
            'due_date' => $this->faker->optional()->dateTimeBetween('now', '+60 days'),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
