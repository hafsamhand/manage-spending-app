<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Expense;

class ExpenseTest extends TestCase
{
    public function test_create_list_update_delete_expense()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create
        $data = [
            'title' => 'Test Expense',
            'amount' => 100,
            'category' => 'Food',
            'spent_at' => now()->toDateString(),
        ];
        $resp = $this->postJson('/api/expenses', $data);
        $resp->assertStatus(201);
        $expenseId = $resp->json('id');

        // List
        $this->getJson('/api/expenses')->assertJsonFragment(['title' => 'Test Expense']);

        // Update
        $this->putJson("/api/expenses/$expenseId", ['title' => 'Updated', 'amount' => 150, 'category' => 'Food', 'spent_at' => now()->toDateString()])
            ->assertJsonFragment(['title' => 'Updated']);

        // Delete
        $this->deleteJson("/api/expenses/$expenseId")->assertJson(['success' => true]);
    }
}
