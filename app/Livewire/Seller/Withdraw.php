<?php

namespace App\Livewire\Seller;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class Withdraw extends Component
{
    public function render()
    {
        return view('seller.withdraw');
    }
}
