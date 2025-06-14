<?php

namespace App\Livewire\Shop;

use App\Models\Category;
use Livewire\Component;

class CategoryFilter extends Component
{
    public function render()
    {
        return view('shop.category-filter', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}
