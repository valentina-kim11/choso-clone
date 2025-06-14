<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_non_admin_cannot_access_admin_routes(): void
    {
        $user = User::factory()->create(['role' => User::ROLE_BUYER]);
        $this->actingAs($user);

        $this->get('/admin')->assertStatus(403);
        $this->get('/admin/withdrawals')->assertStatus(403);
    }

    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::factory()->create(['role' => User::ROLE_ADMIN]);
        $this->actingAs($admin);

        $this->get('/admin')->assertRedirect('/admin/withdrawals');
        $this->get('/admin/withdrawals')->assertStatus(200);
    }
}
