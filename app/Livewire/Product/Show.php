<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Show extends Component
{
    public Product $product;
    public ?string $licenseKey = null;

    public function mount(string $slug): void
    {
        $this->product = Product::where('slug', $slug)
            ->with('category', 'seller')
            ->withSum('orderItems as sales_count', 'quantity')
            ->firstOrFail();

        $user = Auth::user();
        if ($user) {
            $order = $user->orders()
                ->whereHas('items', fn ($q) => $q->where('product_id', $this->product->id))
                ->with('licenseKey')
                ->latest()
                ->first();

            if ($order && $order->licenseKey) {
                $this->licenseKey = $order->licenseKey->key;
            }
        }
    }

    public function addToCart(): void
    {
        $this->dispatch('add-to-cart', id: $this->product->id);
    }

    public function render()
    {
        return view('product.show');
    }
}
