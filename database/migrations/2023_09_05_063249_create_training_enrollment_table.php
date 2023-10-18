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
        Schema::create('training_enrollment', function (Blueprint $table) {
            $table->string('enrollmentID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('userTag', 15)->nullable();
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('trainingID', 15);
            $table->foreign('trainingID')->references('trainingID')->on('training')->onDelete('cascade');;
            $table->string('applicantName', 255);
            $table->string('applicantEmail', 255);
            $table->string('applicantContact', 255);
            $table->string('enrollStatus', 60);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_enrollment');
    }
};
