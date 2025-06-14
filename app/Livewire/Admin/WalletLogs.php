<?php

namespace App\Livewire\Admin;

use App\Models\WalletLog;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class WalletLogs extends Component
{
    public ?int $userId = null;

    public function render()
    {
        $logs = WalletLog::with('user')
            ->when($this->userId, fn ($q) => $q->where('user_id', $this->userId))
            ->latest()
            ->get();

        return view('admin.wallet-logs', [
            'logs' => $logs,
        ]);
    }
}
