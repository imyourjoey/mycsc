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
        Schema::create('training', function (Blueprint $table) {
            $table->string('trainingID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('userTag', 15);
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('trainingTitle', 255);
            $table->integer('trainingCapacity');
            $table->string('trainingVenue', 255);
            $table->text('trainingDesc');
            $table->dateTime('startDateTime');
            $table->dateTime('endDateTime');
            $table->string('trainerName', 255);
            $table->dateTime('regisDeadline');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training');
    }
};
