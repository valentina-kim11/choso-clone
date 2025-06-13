<?php

namespace App\Livewire\Seller;

use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Revenue extends Component
{
    public string $filter = 'month';

    public function render()
    {
        $query = OrderItem::whereHas('product', function ($q) {
            $q->where('user_id', Auth::id());
        })->with('product');

        if ($this->filter === 'day') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($this->filter === 'month') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        }

        $items = $query->get();

        $total = $items->sum(fn($i) => $i->price * $i->quantity);

        $summary = $items->groupBy('product_id')->map(function ($group) {
            $product = $group->first()->product;
            return [
                'product' => $product,
                'quantity' => $group->sum('quantity'),
                'amount' => $group->sum(fn($i) => $i->price * $i->quantity),
            ];
        });

        return view('seller.revenue', [
            'total' => $total,
            'summary' => $summary,
        ]);
    }
}
