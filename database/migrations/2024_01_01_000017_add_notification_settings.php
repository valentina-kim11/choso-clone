<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $now = now();
        DB::table('settings')->insertOrIgnore([
            ['key' => 'telegram_webhook_url', 'value' => '', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'admin_email', 'value' => '', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'notify_via_telegram', 'value' => '1', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'notify_via_email', 'value' => '1', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        DB::table('settings')
            ->whereIn('key', [
                'telegram_webhook_url',
                'admin_email',
                'notify_via_telegram',
                'notify_via_email',
            ])
            ->delete();
    }
};
