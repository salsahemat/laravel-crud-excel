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
        Schema::create('receipt_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('receipt_id')->constrained()->cascadeOnDelete();
      $table->foreignId('item_id')->constrained()->cascadeOnDelete();
      $table->decimal('qty_received',12,2);
      $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipt_items');
    }
};
