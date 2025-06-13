<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Index extends Component
{
    public function render()
    {
        $products = Product::latest()->get();

        return view('shop.index', [
            'products' => $products,
        ]);
    }
}
