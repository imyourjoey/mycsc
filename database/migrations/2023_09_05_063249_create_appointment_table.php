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
        Schema::create('appointment', function (Blueprint $table) {
            $table->string('appointmentID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('appointmentName', 255);
            $table->string('userTag', 15);
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('appointmentContact', 255);
            $table->string('appointmentEmail', 255);
            $table->dateTime('appointmentDateTime');
            $table->string('appointmentStatus', 60);
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
