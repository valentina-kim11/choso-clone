<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Shop\Index as ShopIndex;

Route::get('/', ShopIndex::class)->name('home');

require __DIR__.'/auth.php';
require __DIR__.'/buyer.php';
require __DIR__.'/seller.php';
require __DIR__.'/admin.php';
