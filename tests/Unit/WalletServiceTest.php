<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\WalletService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WalletServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_purchase_deducts_and_logs(): void
    {
        $user = User::factory()->create(['wallet' => 100]);
        $service = new WalletService();

        $this->assertTrue($service->purchase($user, 40, 'Test'));
        $this->assertEquals(60, $user->fresh()->wallet);
        $this->assertDatabaseHas('wallet_logs', [
            'user_id' => $user->id,
            'type' => 'purchase',
            'amount' => 40,
            'description' => 'Test',
        ]);
    }

    public function test_purchase_fails_when_insufficient_balance(): void
    {
        $user = User::factory()->create(['wallet' => 10]);
        $service = new WalletService();

        $this->assertFalse($service->purchase($user, 20, 'Fail'));
        $this->assertEquals(10, $user->fresh()->wallet);
        $this->assertDatabaseCount('wallet_logs', 0);
    }
}
