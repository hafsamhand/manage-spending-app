<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Loan;

class LoanTest extends TestCase
{
    public function test_create_and_mark_as_paid()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create
        $data = [
            'type' => 'borrowed',
            'person' => 'John Doe',
            'amount' => 200,
            'status' => 'pending',
        ];
        $resp = $this->postJson('/api/loans', $data);
        $resp->assertStatus(201);
        $loanId = $resp->json('id');

        // Mark as paid
        $this->patchJson("/api/loans/$loanId/mark-as-paid")->assertJsonFragment(['status' => 'paid']);
    }
}
