<?php

namespace App\Services;

use App\Mail\NewOrderNotification;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function orderCreated(Order $order): void
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
