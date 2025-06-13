<?php

namespace App\Livewire\Seller;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Orders extends Component
{
    public function render()
    {
        $orders = Order::whereHas('items.product', function ($q) {
            $q->where('user_id', Auth::id());
        })
            ->with(['items.product', 'buyer'])
            ->get();

        return view('seller.orders', [
            'orders' => $orders,
        ]);
    }
}
