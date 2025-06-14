<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Withdrawals;
use App\Livewire\Admin\WalletLogs;

use App\Livewire\Admin\AdminApproveSeller;
use App\Livewire\Admin\TopUpWallet;

use App\Livewire\Admin\TopUpWallet;
use App\Livewire\Admin\AdminApproveSeller;
use App\Livewire\Admin\ManageCategories;
use App\Livewire\AdminCouponManager;

use App\Livewire\Settings\Appearance;

Route::middleware(['auth', 'adminOnly'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/', fn () => redirect()->route('admin.withdrawals'))
            ->name('dashboard');
        Route::get('/withdrawals', Withdrawals::class)->name('withdrawals');
        Route::get('/wallet-logs', WalletLogs::class)->name('wallet-logs');

        Route::get('/approve-sellers', AdminApproveSeller::class)->name('approve-sellers');
        Route::get('/topup-wallet', TopUpWallet::class)->name('topup-wallet');

        Route::get('/top-up-wallet', TopUpWallet::class)->name('top-up-wallet');
        Route::get('/approve-sellers', AdminApproveSeller::class)->name('approve-sellers');
        Route::get('/categories', ManageCategories::class)->name('categories');
        Route::get('/coupons', AdminCouponManager::class)->name('coupons');

        Route::get('/appearance', Appearance::class)->name('appearance');
    });

