<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\WalletLog;
use Illuminate\Support\Facades\DB;



class CheckoutService
{
    public function pay(User $user, array $items): ?Order
    {
        // Calculate total amount for the order
        $total = collect($items)
            ->sum(fn ($i) => $i['product']->price * $i['quantity']);

        if ($user->wallet < $total) {
            return null; // insufficient funds
        }

        // Wrap all operations in a single database transaction
        return DB::transaction(function () use ($user, $items, $total) {
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

            return $order;
        });
    }
}
