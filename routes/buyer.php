<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Services\PdfService;
use App\Models\OrderItem;
use App\Livewire\Shop\Index as ShopIndex;
use App\Livewire\Shop\Show as ShopShow;
use App\Livewire\Shop\Cart as ShopCart;
use App\Livewire\Shop\Checkout as ShopCheckout;
use App\Livewire\Shop\ThankYou as ShopThankYou;
use App\Livewire\Orders\History as OrdersHistory;
use App\Livewire\Buyer\WalletLogs as BuyerWalletLogs;

Route::middleware(['auth', 'buyerOnly'])->group(function () {
    Route::get('/products', ShopIndex::class)->name('shop.index');
    Route::get('/products/{product}', ShopShow::class)->name('shop.show');
    Route::get('/cart', ShopCart::class)->name('shop.cart');
    Route::get('/checkout', ShopCheckout::class)->name('shop.checkout');
    Route::get('/thank-you', ShopThankYou::class)->name('shop.thank-you');
    Route::get('/orders/history', OrdersHistory::class)->name('orders.history');
    Route::get('/shop/wallet-logs', BuyerWalletLogs::class)->name('shop.wallet-logs');

    Route::get('/download/{orderItem}', function (OrderItem $orderItem, PdfService $pdfService) {
        $user = Auth::user();

        if (! $user || $orderItem->order->user_id !== $user->id) {
            abort(403);
        }

        if ($orderItem->downloadLogs()->count() >= 5) {
            abort(403, 'Download limit reached');
        }

        if ($orderItem->order->created_at->lt(now()->subDays(3))) {
            abort(403, 'Download period expired');
        }

        $orderItem->downloadLogs()->create([
            'user_id'    => $user->id,
            'ip_address' => request()->ip(),
        ]);

        $path = $orderItem->product->file_path;
        if (Str::endsWith($path, '.pdf')) {
            $source = Storage::disk('products')->path($path);
            $temp = tempnam(sys_get_temp_dir(), 'pdf');
            $tempPdf = $temp . '.pdf';
            $pdfService->addWatermark($source, $tempPdf, $user->email);

            return response()->download($tempPdf, basename($path))->deleteFileAfterSend(true);
        }

        return Storage::disk('products')->download($path);
    })->name('download');
});

