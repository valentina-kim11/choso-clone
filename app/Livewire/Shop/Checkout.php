<?php

namespace App\Livewire\Shop;

use App\Services\CheckoutService;
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

        $service = app(CheckoutService::class);
        $order = $service->pay($user, $this->items);

        if (! $order) {
            session()->flash('status', __('Insufficient wallet balance'));
            return null;
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
