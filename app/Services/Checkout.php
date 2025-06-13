<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $downloads = [];

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

            // generate temporary download URL for each item
            if ($product->file_path) {
                $downloads[] = Storage::disk('local')->temporaryUrl(
                    $product->file_path,
                    now()->addMinutes(30)
                );
            }

            $total += $price * $quantity;
        }

        $order->amount = $total;
        $order->save();

        // flash the thank you message and download URLs
        session()->flash('status', 'Cảm ơn bạn đã mua hàng');
        session()->flash('downloads', $downloads);

        if (!empty($downloads)) {
            Log::info('Checkout download URLs', $downloads);
        }

        return $order;
    }
}
