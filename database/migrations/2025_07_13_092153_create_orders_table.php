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
        Schema::create('orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('shipper_id')->constrained('shippers')->onDelete('cascade');
    $table->string('tracking_number')->unique();
    $table->string('order_number')->nullable();
    $table->string('customer_name');
    $table->string('customer_phone');
    $table->text('customer_address');
    $table->decimal('cod_amount', 10, 2)->default(0);
    $table->decimal('delivery_charges', 10, 2)->default(0);
    $table->enum('status', [
        'booked', 'out_for_destination', 'arrived', 'out_for_delivery',
        'delivered', 'reattempt', 'refused', 'returned', 'halt'
    ])->default('booked');
    $table->foreignId('rider_id')->nullable()->constrained('riders')->onDelete('set null');
    $table->date('assigned_date')->nullable();
    $table->date('delivered_date')->nullable();
    $table->enum('payment_status', ['pending', 'paid_to_shipper'])->default('pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
