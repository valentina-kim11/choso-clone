<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Services\PdfService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class DownloadPdfTest extends TestCase
{
    use RefreshDatabase;

    public function test_watermark_service_is_called_for_pdf_download(): void
    {
        Storage::fake('products');

        $buyer = User::factory()->create(['role' => User::ROLE_BUYER, 'email' => 'buyer@example.com']);
        $seller = User::factory()->create(['role' => User::ROLE_SELLER]);
        $category = Category::create(['name' => 'cat', 'slug' => 'cat']);

        Storage::disk('products')->put('file.pdf', 'dummy');

        $product = Product::create([
            'user_id' => $seller->id,
            'category_id' => $category->id,
            'name' => 'Prod',
            'slug' => 'prod',
            'price' => 10,
            'description' => '',
            'file_path' => 'file.pdf',
        ]);

        $order = Order::create([
            'user_id' => $buyer->id,
            'product_id' => $product->id,
            'amount' => 10,
            'status' => 'completed',
        ]);

        $orderItem = OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'price' => 10,
        ]);

        $mock = Mockery::mock(PdfService::class);
        $mock->shouldReceive('addWatermark')
            ->once()
            ->andReturnUsing(function ($src, $out) {
                file_put_contents($out, 'result');
            });
        $this->instance(PdfService::class, $mock);

        $this->actingAs($buyer);
        $this->get('/download/' . $orderItem->id)->assertOk();

        Mockery::close();
    }
}
