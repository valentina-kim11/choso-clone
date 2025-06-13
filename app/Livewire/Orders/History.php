<?php

namespace App\Livewire\Orders;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class History extends Component
{
    public function render()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();

        return view('orders.history', [
            'orders' => $orders,
        ]);
    }
}
