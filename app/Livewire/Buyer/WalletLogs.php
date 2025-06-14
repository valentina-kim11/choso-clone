<?php

namespace App\Livewire\Buyer;

use App\Models\WalletLog;
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

        return view('buyer.wallet-logs', [
            'logs' => $logs,
        ]);
    }
}
