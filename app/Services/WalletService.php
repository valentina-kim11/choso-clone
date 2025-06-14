<?php

namespace App\Services;

use App\Models\User;
use App\Models\WalletLog;

class WalletService
{
    /**
     * Check if the user has enough wallet balance.
     */
    public function hasBalance(User $user, float $amount): bool
    {
        return $user->wallet >= $amount;
    }

    /**
     * Deduct amount from wallet and record a purchase log.
     */
    public function purchase(User $user, float $amount, string $description): bool
    {
        if (! $this->hasBalance($user, $amount)) {
            return false;
        }

        $user->decrement('wallet', $amount);

        WalletLog::create([
            'user_id'     => $user->id,
            'type'        => 'purchase',
            'amount'      => $amount,
            'description' => $description,
        ]);

        return true;
    }
}
