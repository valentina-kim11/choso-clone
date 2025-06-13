<?php

namespace App\Livewire\Shop;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class ThankYou extends Component
{
    public ?Order $order = null;

    public function mount(): void
    {
        $orderId = session('order_id');
        if ($orderId) {
            $this->order = Order::with('items.product')->find($orderId);
        }
    }

    public function render()
    {
        return view('shop.thank-you');
    }
}
