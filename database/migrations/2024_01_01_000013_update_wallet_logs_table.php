<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('wallet_logs', function (Blueprint $table) {
            $table->boolean('by_admin')->default(false)->after('amount');
            $table->string('type')->change();
        });
    }

    public function down(): void
    {
        Schema::table('wallet_logs', function (Blueprint $table) {
            $table->dropColumn('by_admin');
            $table->enum('type', ['purchase', 'withdraw', 'deposit', 'refund'])->change();
        });
    }
};
