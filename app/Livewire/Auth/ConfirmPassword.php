<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class ConfirmPassword extends Component
{
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $user = Auth::user();
        $redirect = match ($user->role) {
            User::ROLE_ADMIN => '/admin',
            User::ROLE_SELLER => route('seller.dashboard', absolute: false),
            default => route('shop.index', absolute: false),
        };

        $this->redirectIntended(default: $redirect, navigate: true);
    }
}
