<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    use RefreshDatabase;

    public function test_product_page_shows_details(): void
    {
        $seller = User::factory()->create(['role' => User::ROLE_SELLER]);
        $category = Category::create(['name' => 'Cat', 'slug' => 'cat']);

        $product = Product::create([
            'user_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'My Product',
            'slug' => 'my-product',
            'price' => 10,
            'description' => 'Long desc',
            'file_path' => 'p.zip',
        ]);

        $this->get('/product/' . $product->slug)
            ->assertStatus(200)
            ->assertSee('My Product')
            ->assertSee('Long desc');
    }
}
