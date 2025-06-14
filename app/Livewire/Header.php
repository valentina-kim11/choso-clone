<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Header extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->count = count(session('cart.items', []));
    }

    #[On('cart-updated')]
    public function updateCount(int $count): void
    {
        $this->count = $count;
    }

    public function render()
    {
        return view('components.layouts.header');
    }
}
