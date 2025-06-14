<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Withdrawals;
use App\Livewire\Admin\WalletLogs;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.withdrawals'))
            ->name('dashboard');
        Route::get('/withdrawals', Withdrawals::class)->name('withdrawals');
        Route::get('/wallet-logs', WalletLogs::class)->name('wallet-logs');
    });
