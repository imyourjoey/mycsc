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
        Schema::create('order', function (Blueprint $table) {
            $table->string('orderID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('clientTag', 15);
            $table->foreign('clientTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('serviceID', 15);
            $table->foreign('serviceID')->references('serviceID')->on('service')->onDelete('cascade')->onUpdate('cascade');
            $table->string('technicianTag', 15);
            $table->foreign('technicianTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('deviceType', 60);
            $table->text('hardwareManufacturer')->nullable();
            $table->string('partNo', 255)->nullable();
            $table->string('serialNo', 255)->nullable();
            $table->double('diskCapacity')->nullable();
            $table->double('capacityRestored')->nullable();
            $table->string('othersIncluded', 255)->nullable();
            $table->string('orderStatus', 60);
            $table->string('orderStatusPic', 255)->nullable();
            $table->text('orderRemarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
