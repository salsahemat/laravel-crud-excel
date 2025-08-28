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
        Schema::create('purchase_orders', function (Blueprint $table) {
      $table->id();
      $table->string('po_num')->unique();
      $table->foreignId('supplier_id')->constrained()->cascadeOnDelete();
      $table->foreignId('need_id')->nullable()->constrained()->nullOnDelete();
      $table->string('shipping_method')->nullable();
      $table->string('payment_method')->nullable();
      $table->enum('status',['draft','submitted','approved','emailed'])->default('draft');
      $table->foreignId('approved_by')->nullable();
      $table->timestamp('approved_at')->nullable();
      $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
