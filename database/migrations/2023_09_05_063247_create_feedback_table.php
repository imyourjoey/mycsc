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
        Schema::create('feedback', function (Blueprint $table) {
            $table->string('feedbackID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('userTag', 15);
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->longText('feedbackMessage');
            $table->integer('feedbackRating');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
