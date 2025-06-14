<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Support\Facades\DB;
use App\Services\OrderCreator;
use App\Services\WalletService;
use App\Services\NotificationService;



class CheckoutService
{
    public function __construct(
        protected OrderCreator $creator,
        protected WalletService $wallet,
        protected NotificationService $notifications,
    ) {
    }

    public function pay(User $user, array $items, ?Coupon $coupon = null): ?Order
    {
        $baseTotal = collect($items)->sum(fn ($i) => $i['product']->price * $i['quantity']);

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

        if (! $this->wallet->hasBalance($user, $total)) {
            return null; // insufficient funds
        }

        $order = DB::transaction(function () use ($user, $items, $total, $coupon) {
            $order = $this->creator->create($user, $items, $total);

            if (! $this->wallet->purchase($user, $total, 'Order #' . $order->id)) {
                throw new \RuntimeException('Wallet deduction failed');
            }

            if ($coupon) {
                $coupon->increment('used');
            }

            return $order;
        });

        if ($order) {
            $order->load('items.product.seller', 'buyer');
            $this->notifications->orderCreated($order);
        }

        return $order;
    }
}
