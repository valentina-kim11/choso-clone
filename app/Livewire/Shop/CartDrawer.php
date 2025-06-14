<?php

namespace App\Livewire\Shop;

use Livewire\Attributes\On;
use Livewire\Component;

class CartDrawer extends Component
{
    public bool $open = false;

    #[On('toggle-cart')]
    public function toggle(): void
    {
        $this->open = ! $this->open;
    }

    #[On('add-to-cart')]
    public function open(): void
    {
        $this->open = true;
    }

    public function render()
    {
        return view('shop.cart-drawer');
    }
}
