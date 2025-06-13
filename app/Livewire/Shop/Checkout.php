<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

#[Layout('components.layouts.market')]
class Checkout extends Component
{
    public array $items = [];

    public function mount(): void
    {
        $this->loadFromSession();
    }

    public function pay(): RedirectResponse|null
    {
        $user = Auth::user();

        if (! $user) {
            return null;
        }

        $total = $this->total();
        $wallet = $user->wallet;

        if ($wallet->balance < $total) {
            session()->flash('status', __('Insufficient wallet balance'));
            return null;
        }

        $wallet->decrement('balance', $total);

        $order = Order::create([
            'user_id' => $user->id,
            'amount' => $total,
            'status' => 'completed',
        ]);

        foreach ($this->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
            ]);
        }

        $this->clear();
        $this->dispatch('cart-cleared');
        session()->flash('order_id', $order->id);

        return redirect()->route('shop.thank-you');
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
