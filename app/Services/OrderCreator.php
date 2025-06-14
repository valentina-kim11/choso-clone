<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\LicenseKey;
use App\Models\User;
use Illuminate\Support\Str;

class OrderCreator
{
    /**
     * Create an order with items and generate a license key.
     *
     * @param User  $user
     * @param array $items array of ['product' => Product, 'quantity' => int]
     * @param float $total
     */
    public function create(User $user, array $items, float $total): Order
    {
        $order = Order::create([
            'user_id' => $user->id,
            'amount'  => $total,
            'status'  => 'completed',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product']->id,
                'quantity'   => $item['quantity'],
                'price'      => $item['product']->price,
            ]);
        }

        LicenseKey::create([
            'order_id' => $order->id,
            'key'      => (string) Str::uuid(),
        ]);

        return $order;
    }
}
