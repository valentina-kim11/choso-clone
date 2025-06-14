<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class AdminApproveSeller extends Component
{
    public function approve(User $user): void
    {
        if ($user->role !== User::ROLE_SELLER || $user->is_approved) {
            return;
        }

        $user->is_approved = true;
        $user->save();

        session()->flash('status', 'Duyệt thành công!');

        $this->dispatch('$refresh');
    }

    public function render()
    {
        $sellers = User::where('role', User::ROLE_SELLER)
            ->where('is_approved', false)
            ->latest()
            ->get();

        return view('admin.approve-seller', [
            'sellers' => $sellers,
        ]);
    }
}
