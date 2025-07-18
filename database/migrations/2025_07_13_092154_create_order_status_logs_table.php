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
        Schema::create('order_status_logs', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
    $table->enum('status', [
        'booked', 'out_for_destination', 'arrived', 'out_for_delivery',
        'delivered', 'reattempt', 'refused', 'returned', 'halt'
    ]);
    $table->foreignId('changed_by_id')->constrained('users')->onDelete('cascade');
    $table->text('remarks')->nullable();
    $table->timestamp('created_at')->useCurrent();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status_logs');
    }
};
