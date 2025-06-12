<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('payment_id')->nullable()->after('status');
            $table->string('payment_method')->nullable()->after('payment_id');
            $table->string('payment_status')->default('pending')->after('payment_method');
            $table->string('xendit_invoice_id')->nullable()->after('payment_status');
            $table->string('xendit_invoice_url')->nullable()->after('xendit_invoice_id');
            $table->timestamp('paid_at')->nullable()->after('xendit_invoice_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'payment_id',
                'payment_method', 
                'payment_status',
                'xendit_invoice_id',
                'xendit_invoice_url',
                'paid_at'
            ]);
        });
    }
};
