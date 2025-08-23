<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;

class AuthTest extends TestCase
{
    public function test_guest_cannot_access_app_pages()
    {
        $this->get('/dashboard')->assertRedirect('/login');
        $this->get('/expenses')->assertRedirect('/login');
        $this->get('/loans')->assertRedirect('/login');
    }

    public function test_user_can_access_app_pages()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
            ->get('/dashboard')
            ->assertStatus(200);
    }
}
