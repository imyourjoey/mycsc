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
        Schema::create('inquiry', function (Blueprint $table) {
            $table->string('inquiryID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('userTag', 15)->nullable();
            $table->foreign('userTag')->references('userTag')->on('users')->onUpdate('cascade');
            $table->string('inquiryName', 255);
            $table->longText('inquiryMessage');
            $table->longText('inquiryReply')->nullable();
            $table->string('inquiryContactEmail', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inquiry');
    }
};
