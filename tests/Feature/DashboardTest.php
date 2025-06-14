<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_access_homepage(): void
    {
        $this->get('/')->assertStatus(200);
    }

    public function test_authenticated_users_can_access_homepage(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/')->assertStatus(200);
    }
}
