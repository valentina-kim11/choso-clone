<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Coupon;
use App\Models\WalletLog;
use App\Models\LicenseKey;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;



class CheckoutService
{
    public function pay(User $user, array $items, ?Coupon $coupon = null): ?Order
    {
        // Calculate total amount for the order
        $baseTotal = collect($items)
            ->sum(fn ($i) => $i['product']->price * $i['quantity']);


        // Wrap all operations in a single database transaction
        $order = DB::transaction(function () use ($user, $items, $baseTotal, $coupon) {
            // Re-check coupon validity within the transaction
            $discount = 0;
            if ($coupon) {
                $coupon->refresh();
                if (! $coupon->isExpired() && ! $coupon->isMaxed()) {
                    $discount = $coupon->type === 'percent'
                        ? $baseTotal * $coupon->value / 100
                        : $coupon->value;
                    $discount = min($discount, $baseTotal);
                } else {
                    $coupon = null;
                }
            }

            $total = $baseTotal - $discount;

            if ($user->wallet < $total) {
                return null; // insufficient funds
            }


        $discount = 0;
        if ($coupon) {
            $discount = $coupon->type === 'percent'
                ? $total * $coupon->value / 100
                : $coupon->value;
            $discount = min($discount, $total);
            $total -= $discount;
        }

        if ($user->wallet < $total) {
            return null; // insufficient funds
        }

        // Wrap all operations in a single database transaction
        return DB::transaction(function () use ($user, $items, $total, $coupon) {

            // Deduct wallet balance
            $user->decrement('wallet', $total);

            // Create the order record
            $order = Order::create([
                'user_id' => $user->id,
                'amount'  => $total,
                'status'  => 'completed',
            ]);

            // Store each purchased item
            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity'   => $item['quantity'],
                    'price'      => $item['product']->price,
                ]);
            }

            // Log wallet transaction
            WalletLog::create([
                'user_id'     => $user->id,
                'type'        => 'purchase',
                'amount'      => $total,
                'description' => 'Order #' . $order->id,
            ]);

            if ($coupon) {
                $coupon->increment('used');
            }


            LicenseKey::create([
                'order_id' => $order->id,
                'key'      => (string) Str::uuid(),
            ]);


            return $order;
        });

        if ($order) {
            $order->load('items.product.seller', 'buyer');
            $this->notifyOrder($order);
        }

        return $order;
    }

    protected function notifyOrder(Order $order): void
    {
        if (setting('notify_via_telegram', true) && ($url = setting('telegram_webhook_url'))) {
            try {
                Http::post($url, [
                    'text' => '📦 Đơn hàng mới từ ' . $order->buyer->email . "\nTổng: " . number_format($order->amount) . 'đ',
                ]);
            } catch (\Throwable $e) {
                // ignore
            }
        }

        if (setting('notify_via_email', true)) {
            $emails = [];
            if ($admin = setting('admin_email')) {
                $emails[] = $admin;
            }

            foreach ($order->items as $item) {
                if ($email = $item->product->seller->email) {
                    $emails[] = $email;
                }
            }

            $emails = array_unique($emails);
            if ($emails) {
                Mail::to($emails)->send(new NewOrderNotification($order));
            }
        }
    }
}
