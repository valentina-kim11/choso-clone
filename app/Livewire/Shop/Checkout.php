<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.market')]
class Checkout extends Component
{
    public array $items = [];

    public function mount(): void
    {
        $this->loadFromSession();
    }

    public function pay(): void
    {
        $user = Auth::user();

        if (! $user) {
            return;
        }

        $total = $this->total();
        $wallet = $user->wallet;

        if ($wallet->balance < $total) {
            session()->flash('status', __('Insufficient wallet balance'));
            return;
        }

        $wallet->decrement('balance', $total);

        foreach ($this->items as $item) {
            Order::create([
                'user_id' => $user->id,
                'product_id' => $item['product']->id,
                'amount' => $item['product']->price * $item['quantity'],
                'status' => 'completed',
            ]);
        }

        $this->clear();
        $this->dispatch('cart-cleared');
        session()->flash('status', __('Payment successful!'));
    }

    protected function total(): float
    {
        return collect($this->items)
            ->sum(fn ($item) => $item['product']->price * $item['quantity']);
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

    protected function clear(): void
    {
        $this->items = [];
        session()->forget('cart.items');
    }

    public function render()
    {
        return view('shop.checkout', [
            'total' => $this->total(),
        ]);
    }
}
