<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;

class Checkout
{
    public static function pay(User $user, array $items): Order
    {
        $order = Order::create([
            'user_id' => $user->id,
            'amount' => 0,
            'status' => 'pending',
        ]);

        $total = 0;

        foreach ($items as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];
            $price = $product->price;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
            ]);

            $total += $price * $quantity;
        }

        $order->amount = $total;
        $order->save();

        return $order;
    }
}
