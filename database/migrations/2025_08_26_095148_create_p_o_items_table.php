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
        Schema::create('p_o_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('purchase_order_id')->constrained()->cascadeOnDelete();
      $table->foreignId('item_id')->constrained()->cascadeOnDelete();
      $table->decimal('qty',12,2);
      $table->decimal('unit_price',14,2);
      $table->decimal('subtotal',14,2);
      $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('p_o_items');
    }
};
