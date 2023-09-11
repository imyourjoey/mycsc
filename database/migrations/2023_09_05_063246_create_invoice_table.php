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
        Schema::create('invoice', function (Blueprint $table) {
            $table->string('invoiceID', 15)->primary();
            $table->string('orderID', 15);
            $table->foreign('orderID')->references('orderID')->on('order')->onDelete('cascade')->onUpdate('cascade');
            $table->string('userTag', 15);
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('totalPayable', 10, 2);
            $table->datetime('invoiceDueDate')->nullable();
            $table->string('paymentStatus', 60)->nullable();
            $table->decimal('paymentAmount', 10, 2)->nullable();
            $table->string('paymentMethod', 60)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
