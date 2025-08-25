<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Expense;
use Illuminate\Support\Str;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(3),
            'amount' => $this->faker->randomFloat(2, 1, 200),
            'category' => $this->faker->randomElement(['Food','Transport','Bills','Other']),
            'spent_at' => $this->faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'description' => $this->faker->optional()->sentence(),
        ];
    }
}
