<?php

namespace App\Livewire\Shop;

use App\Models\Product;


use App\Services\CheckoutService;
use Illuminate\Support\Facades\Auth;


use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Cart extends Component
{
    public array $items = [];
    public function mount(): void
    {
        $this->loadFromSession();
    }


    #[On('add-to-cart')]
    public function add(int $productId)
    {
        $product = Product::findOrFail($productId);

        if (isset($this->items[$productId])) {
            $this->items[$productId]['quantity']++;
        } else {
            $this->items[$productId] = [
                'product' => $product,
                'quantity' => 1,
            ];
        }
        $this->storeToSession();
    }

    public function remove(int $productId)
    {
        unset($this->items[$productId]);
        $this->storeToSession();
    }

    public function clear(): void
    {
        $this->items = [];
        session()->forget('cart.items');
    }

    #[On('cart-cleared')]
    public function handleClear(): void
    {
        $this->clear();
    }

    protected function loadFromSession(): void
    {
        $stored = session('cart.items', []);
        foreach ($stored as $id => $quantity) {
            $product = Product::find($id);
            if ($product) {
                $this->items[$id] = [
                    'product' => $product,
                    'quantity' => $quantity,
                ];
            }
        }
    }

    protected function storeToSession(): void
    {
        $sessionItems = [];
        foreach ($this->items as $id => $item) {
            $sessionItems[$id] = $item['quantity'];
        }

        session(['cart.items' => $sessionItems]);
    }



    public function pay()
    {
        app(CheckoutService::class)->pay(Auth::user(), $this->items);
        $this->items = [];

        return redirect()->route('checkout.success');



    }



    public function render()
    {
        return view('shop.cart');
    }
}
