<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.market')]
class WalletLogs extends Component
{
    public ?string $viewerType = null;

    public function mount(): void
    {
        $this->viewerType ??= Auth::user()?->role;
    }

    public function render()
    {
        $logs = [];
        if ($user = Auth::user()) {
            $logs = $user->walletLogs()->latest()->get();
        }

        return view('wallet-logs', [
            'logs' => $logs,
            'viewerType' => $this->viewerType,
        ]);
    }
}
