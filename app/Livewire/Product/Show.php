<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Show extends Component
{
    public Product $product;

    public function mount(string $slug): void
    {
        $this->product = Product::where('slug', $slug)
            ->with('category', 'seller')
            ->firstOrFail();
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
