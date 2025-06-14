<?php

namespace App\Livewire\Shop;

use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Index extends Component
{
    #[Url(as: 'category')]
    public ?string $category = null;

    public function render()
    {
        $query = Product::latest();

        if ($this->category) {
            $category = Category::where('slug', $this->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        $products = $query->get();

        return view('shop.index', [
            'products' => $products,
        ]);
    }
}
