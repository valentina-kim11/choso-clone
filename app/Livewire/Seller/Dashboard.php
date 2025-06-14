<?php

namespace App\Livewire\Seller;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Dashboard extends Component
{
    public function render()
    {
        $sellerId = Auth::id();

        $revenue = OrderItem::whereHas('product', fn ($q) => $q->where('user_id', $sellerId))
            ->sum(DB::raw('quantity * price'));

        $orderCount = OrderItem::whereHas('product', fn ($q) => $q->where('user_id', $sellerId))
            ->distinct('order_id')
            ->count('order_id');

        $productCount = Product::where('user_id', $sellerId)->count();

        $topProducts = Product::withSum('orderItems as total_quantity', 'quantity')
            ->where('user_id', $sellerId)
            ->orderByDesc('total_quantity')
            ->take(5)
            ->get();

        return view('seller.dashboard', [
            'revenue'      => $revenue,
            'orderCount'   => $orderCount,
            'productCount' => $productCount,
            'topProducts'  => $topProducts,
        ]);
    }
}
