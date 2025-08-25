<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class DashboardTest extends TestCase
{
    public function test_stats_json_endpoint_shape()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $resp = $this->getJson('/api/stats');
        $resp->assertStatus(200)
            ->assertJsonStructure([
                'totalSpent',
                'totalBorrowed',
                'totalGiven',
            ]);
    }
}
