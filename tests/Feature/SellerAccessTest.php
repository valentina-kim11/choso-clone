<?php

namespace Tests\Feature;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SellerAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_buyer_cannot_access_seller_routes(): void
    {
        $buyer = User::factory()->create(['role' => User::ROLE_BUYER]);

        $this->actingAs($buyer);
        $this->get('/seller')->assertStatus(403);
        $this->get('/seller/dashboard')->assertStatus(403);
        $this->get('/seller/orders')->assertStatus(403);
    }

    public function test_seller_sees_only_their_data(): void
    {
        $seller1 = User::factory()->create(['role' => User::ROLE_SELLER]);
        $seller2 = User::factory()->create(['role' => User::ROLE_SELLER]);
        $buyer = User::factory()->create(['role' => User::ROLE_BUYER]);

        $category = Category::create(['name' => 'cat', 'slug' => 'cat']);

        $product1 = Product::create([
            'user_id' => $seller1->id,
            'category_id' => $category->id,
            'name' => 'Product1',
            'slug' => 'product1',
            'price' => 10,
            'description' => '',
            'file_path' => 'p1',
        ]);
        $product2 = Product::create([
            'user_id' => $seller2->id,
            'category_id' => $category->id,
            'name' => 'Product2',
            'slug' => 'product2',
            'price' => 20,
            'description' => '',
            'file_path' => 'p2',
        ]);

        $order1 = Order::create([
            'user_id' => $buyer->id,
            'amount' => 10,
            'status' => 'completed',
        ]);
        $order2 = Order::create([
            'user_id' => $buyer->id,
            'amount' => 20,
            'status' => 'completed',
        ]);

        OrderItem::create(['order_id' => $order1->id, 'product_id' => $product1->id, 'quantity' => 1, 'price' => 10]);
        OrderItem::create(['order_id' => $order2->id, 'product_id' => $product2->id, 'quantity' => 1, 'price' => 20]);

        $this->actingAs($seller1);

        $this->get('/products/my')
            ->assertSee('Product1')
            ->assertDontSee('Product2');

        $this->get('/seller/orders')
            ->assertSee('Product1')
            ->assertDontSee('Product2');
    }
}
