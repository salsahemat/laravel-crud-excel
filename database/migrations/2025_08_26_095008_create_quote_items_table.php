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
        Schema::create('quote_items', function (Blueprint $table) {
      $table->id();
      $table->foreignId('quote_id')->constrained()->cascadeOnDelete();
      $table->foreignId('item_id')->constrained()->cascadeOnDelete();
      $table->decimal('price',14,2);
      $table->string('pack_info')->nullable();
      $table->timestamps();
      $table->unique(['quote_id','item_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quote_items');
    }
};
