<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Services\Checkout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Cart extends Component
{
    public array $items = [];

    #[On('add-to-cart')]
    public function add(int $productId)
    {
        $product = Product::findOrFail($productId);
        $this->items[$productId] = [
            'product' => $product,
            'quantity' => ($this->items[$productId]['quantity'] ?? 0) + 1,
        ];
    }

    public function remove(int $productId)
    {
        unset($this->items[$productId]);
    }

    public function pay()
    {
        Checkout::pay(Auth::user(), $this->items);
        $this->items = [];

        return redirect()->route('checkout.success');
    }

    public function render()
    {
        return view('shop.cart');
    }
}
