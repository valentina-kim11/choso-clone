<?php

namespace App\Livewire\Seller;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.market')]
class WalletLogs extends Component
{
    public function render()
    {
        $logs = [];
        if ($user = Auth::user()) {
            $logs = $user->walletLogs()->latest()->get();
        }

        return view('seller.wallet-logs', [
            'logs' => $logs,
        ]);
    }
}
