<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Shop\Index as ShopIndex;
use App\Livewire\Product\Show as ProductShow;

Route::get('/', ShopIndex::class)->name('home');
Route::get('/product/{slug}', ProductShow::class)->name('product.show');

require __DIR__.'/auth.php';
require __DIR__.'/buyer.php';
require __DIR__.'/seller.php';
require __DIR__.'/admin.php';
