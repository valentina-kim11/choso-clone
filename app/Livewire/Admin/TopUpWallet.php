<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Models\WalletLog;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class TopUpWallet extends Component
{
    use WithPagination;

    public string $search = '';
    public array $amounts = [];

    public function topUp(User $user): void
    {
        $key = (string) $user->id;
        $this->validate([
            'amounts.' . $key => 'required|integer|min:1',
        ]);

        $amount = (int) ($this->amounts[$key] ?? 0);
        if ($amount <= 0) {
            return;
        }

        DB::transaction(function () use ($user, $amount) {
            $user->increment('wallet', $amount);

            WalletLog::create([
                'user_id'    => $user->id,
                'type'       => 'deposit',
                'amount'     => $amount,
                'description'=> 'Top up by admin',
                'by_admin'   => true,
            ]);
        });

        $this->amounts[$user->id] = '';
        session()->flash('status', __('Wallet topped up'));
    }

    public function render()
    {
        $users = User::query()
            ->when($this->search, fn ($q) => $q->where(function ($sub) {
                $sub->where('email', 'like', "%{$this->search}%")
                    ->orWhere('name', 'like', "%{$this->search}%");
            }))
            ->whereIn('role', [User::ROLE_BUYER, User::ROLE_SELLER])
            ->latest()
            ->paginate(10);

        return view('admin.top-up-wallet', [
            'users' => $users,
        ]);
    }
}
