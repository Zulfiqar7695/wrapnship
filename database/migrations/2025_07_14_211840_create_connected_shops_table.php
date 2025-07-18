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
        Schema::create('connected_shops', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // Link to shipper user
    $table->string('shop_domain');
    $table->string('access_token');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('connected_shops');
    }
};
