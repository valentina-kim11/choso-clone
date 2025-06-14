<?php

namespace App\Livewire\Orders;


use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;




#[Layout('components.layouts.market')]
class History extends Component
{
    public function render()
    {

        $orders = [];
        if ($user = Auth::user()) {
            $orders = $user->orders()
                ->with(['items.product', 'licenseKey'])
                ->latest()
                ->get();
        }




        return view('orders.history', [
            'orders' => $orders,
        ]);
    }
}
