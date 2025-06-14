<?php

namespace App\Livewire\Seller;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class MyProducts extends Component
{
    public function delete(int $id): void
    {
        Product::where('id', $id)->where('user_id', Auth::id())->delete();
    }

    public function render()
    {
        $products = Product::where('user_id', Auth::id())->get();

        return view('seller.my-products', [
            'products' => $products,
        ]);
    }
}
