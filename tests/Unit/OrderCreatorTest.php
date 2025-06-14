<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Services\OrderCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderCreatorTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_order_with_items_and_license(): void
    {
        $user = User::factory()->create();
        $cat = Category::create(['name' => 'Cat', 'slug' => 'cat']);
        $product = Product::create([
            'user_id' => $user->id,
            'category_id' => $cat->id,
            'name' => 'Prod',
            'slug' => 'prod',
            'price' => 50,
            'description' => 'd',
            'file_path' => 'p.zip',
        ]);

        $creator = new OrderCreator();
        $order = $creator->create($user, [['product' => $product, 'quantity' => 2]], 100);

        $this->assertDatabaseHas('orders', ['id' => $order->id, 'amount' => 100]);
        $this->assertDatabaseHas('order_items', ['order_id' => $order->id, 'product_id' => $product->id, 'quantity' => 2]);
        $this->assertDatabaseHas('license_keys', ['order_id' => $order->id]);
    }
}
