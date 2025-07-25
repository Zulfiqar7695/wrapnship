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
       Schema::create('rider_assignments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('rider_id')->constrained('riders')->onDelete('cascade');
    $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
    $table->foreignId('assigned_by')->constrained('users')->onDelete('cascade');
    $table->enum('status', ['assigned', 'delivered', 'reattempt', 'refused', 'returned']);
    $table->text('remarks')->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rider_assignments');
    }
};
