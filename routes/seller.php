<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Seller\Dashboard as SellerDashboard;
use App\Livewire\Seller\Orders as SellerOrders;
use App\Livewire\Seller\MyProducts;
use App\Livewire\Seller\CreateProduct;
use App\Livewire\Seller\Revenue;
use App\Livewire\Seller\Withdraw;
use App\Livewire\Seller\WalletLogs as SellerWalletLogs;

Route::middleware(['auth', 'sellerOnly'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        Route::get('/', SellerDashboard::class)->name('dashboard');
        Route::get('/orders', SellerOrders::class)->name('orders');
        Route::get('/products/my', MyProducts::class)->name('products.my');
        Route::get('/products/create', CreateProduct::class)->name('products.create');
        Route::get('/revenue', Revenue::class)->name('revenue');
        Route::get('/withdraw', Withdraw::class)->name('withdraw');
        Route::get('/wallet-logs', SellerWalletLogs::class)->name('wallet-logs');
    });

