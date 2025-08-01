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
        Schema::create('invoices', function (Blueprint $table) {
    $table->id();
    $table->foreignId('shipper_id')->constrained('shippers')->onDelete('cascade');
    $table->string('invoice_number')->unique();
    $table->date('invoice_date');
    $table->integer('total_shipments')->default(0);
    $table->decimal('total_cod', 10, 2)->default(0);
    $table->decimal('total_charges', 10, 2)->default(0);
    $table->enum('status', ['pending', 'paid'])->default('pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
