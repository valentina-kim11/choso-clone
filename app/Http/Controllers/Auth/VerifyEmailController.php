<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\User;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            $redirect = $this->redirectPath($request->user());
            return redirect()->intended($redirect.'?verified=1');
        }

        if ($request->user()->markEmailAsVerified()) {
            /** @var \Illuminate\Contracts\Auth\MustVerifyEmail $user */
            $user = $request->user();

            event(new Verified($user));
        }

        $redirect = $this->redirectPath($request->user());

        return redirect()->intended($redirect.'?verified=1');
    }

    protected function redirectPath($user): string
    {
        return match ($user->role) {
            User::ROLE_ADMIN => '/admin',
            User::ROLE_SELLER => route('seller.dashboard', absolute: false),
            default => route('shop.index', absolute: false),
        };
    }
}
