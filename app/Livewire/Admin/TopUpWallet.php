<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\WalletLog;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class TopUpWallet extends Component
{
    public string $search = '';
    public array $amounts = [];

    public function topUp(User $user): void
    {
        $key = (string) $user->id;
        $this->validate([
            'amounts.' . $key => 'required|integer|min:1',
        ]);

        $amount = (int) $this->amounts[$key];

        DB::transaction(function () use ($user, $amount) {
            $user->increment('wallet', $amount);

            WalletLog::create([
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => 'topup',
                'by_admin' => true,
            ]);
        });

        session()->flash('status', 'Nạp ví thành công cho ' . $user->email);

        unset($this->amounts[$key]);
    }

    public function render()
    {
        $users = User::whereIn('role', [User::ROLE_BUYER, User::ROLE_SELLER])
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->get();

        return view('admin.topup-wallet', [
            'users' => $users,
        ]);
    }
}
