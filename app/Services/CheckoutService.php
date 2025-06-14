<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

use App\Models\WalletLog;
use Illuminate\Support\Facades\DB;



use Illuminate\Support\Facades\DB;



class CheckoutService
{
    public function pay(User $user, array $items): ?Order
    {
        $total = collect($items)->sum(fn($i) => $i['product']->price * $i['quantity']);

        if ($user->wallet < $total) {
            return null;
        }


        return DB::transaction(function () use ($user, $items, $total) {
            $user->decrement('wallet', $total);

            $order = Order::create([
                'user_id' => $user->id,
                'amount' => $total,
                'status' => 'completed',
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product']->id,
                    'quantity' => $item['quantity'],
                    'price' => $item['product']->price,
                ]);
            }


            WalletLog::create([
                'user_id' => $user->id,
                'type' => 'purchase',
                'amount' => $total,
                'description' => 'Order #' . $order->id,
            ]);

            return $order;
        });

            return $order;
        });

        $user->decrement('wallet', $total);

        $order = Order::create([
            'user_id' => $user->id,
            'amount' => $total,
            'status' => 'completed',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product']->id,
                'quantity' => $item['quantity'],
                'price' => $item['product']->price,
            ]);
        }

        return $order;


    }
}
