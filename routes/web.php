<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Shop\Index as ShopIndex;
use App\Livewire\Shop\Show as ShopShow;
use App\Livewire\Shop\Cart as ShopCart;
use App\Livewire\Shop\Checkout as ShopCheckout;
use App\Livewire\Shop\ThankYou as ShopThankYou;
use App\Livewire\Orders\History as OrdersHistory;
use App\Livewire\Seller\Dashboard as SellerDashboard;
use Illuminate\Support\Facades\Route;

Route::get('/', ShopIndex::class)->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/products', ShopIndex::class)->name('shop.index');
Route::get('/products/{product}', ShopShow::class)->name('shop.show');
Route::get('/cart', ShopCart::class)->name('shop.cart');
Route::get('/checkout', ShopCheckout::class)
    ->middleware('auth')
    ->name('shop.checkout');
Route::get('/thank-you', ShopThankYou::class)
    ->middleware('auth')
    ->name('shop.thank-you');
Route::get('/orders/history', OrdersHistory::class)
    ->middleware('auth')
    ->name('orders.history');

Route::get('/download/{orderItem}', function (\App\Models\OrderItem $orderItem) {
    $user = \Illuminate\Support\Facades\Auth::user();

    if (! $user || $orderItem->order->user_id !== $user->id) {
        abort(403);
    }

    return \Illuminate\Support\Facades\Storage::disk('products')
        ->download($orderItem->product->file_path);
})->middleware('auth')->name('download');

Route::middleware(['auth', 'seller'])->group(function () {
    Route::get('/seller', SellerDashboard::class)->name('seller.dashboard');
    Route::get('/seller/orders', \App\Livewire\Seller\Orders::class)->name('seller.orders');
    Route::get('/products/my', \App\Livewire\Seller\MyProducts::class)->name('products.my');
    Route::get('/seller/products/create', \App\Livewire\Seller\CreateProduct::class)->name('seller.products.create');
});

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
