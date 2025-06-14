<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class TopUpWallet extends Component
{
    use WithPagination;

    public string $search = '';

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
