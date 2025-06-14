<?php

namespace App\Livewire\Admin;

use App\Models\Withdrawal;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Withdrawals extends Component
{
    public function approve(Withdrawal $withdrawal): void
    {
        if ($withdrawal->status !== 'pending') {
            return;
        }

        DB::transaction(function () use ($withdrawal) {
            $withdrawal->status = 'approved';
            $withdrawal->save();

            $withdrawal->user()->decrement('wallet', $withdrawal->amount);
        });
    }

    public function reject(Withdrawal $withdrawal): void
    {
        if ($withdrawal->status !== 'pending') {
            return;
        }

        DB::transaction(function () use ($withdrawal) {
            $withdrawal->status = 'rejected';
            $withdrawal->note = 'Rejected';
            $withdrawal->save();
        });
    }

    public function render()
    {
        return view('admin.withdrawals', [
            'withdrawals' => Withdrawal::with('user')->latest()->get(),
        ]);
    }
}
