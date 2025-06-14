<?php

namespace Tests\Unit;

use App\Mail\NewOrderNotification;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\CheckoutService;
use App\Services\NotificationService;
use App\Services\OrderCreator;
use App\Services\WalletService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class CheckoutServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_pay_processes_order_and_notifications(): void
    {
        Mail::fake();
        Http::fake();

        $buyer = User::factory()->create(['wallet' => 100]);
        $seller = User::factory()->create(['role' => User::ROLE_SELLER]);
        $cat = Category::create(['name' => 'Cat', 'slug' => 'cat']);
        $product = Product::create([
            'user_id' => $seller->id,
            'category_id' => $cat->id,
            'name' => 'Prod',
            'slug' => 'prod',
            'price' => 30,
            'description' => 'd',
            'file_path' => 'p.zip',
        ]);

        $service = new CheckoutService(new OrderCreator(), new WalletService(), new NotificationService());
        $order = $service->pay($buyer, [['product' => $product, 'quantity' => 1]]);

        $this->assertNotNull($order);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'amount' => 30]);
        $this->assertEquals(70, $buyer->fresh()->wallet);
        $this->assertDatabaseHas('license_keys', ['order_id' => $order->id]);
        Mail::assertSent(NewOrderNotification::class);
    }
}
