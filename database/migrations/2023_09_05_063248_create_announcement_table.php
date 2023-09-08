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
        Schema::create('announcement', function (Blueprint $table) {
            $table->string('announcementID', 15)->primary(); // Specify the VARCHAR type and length for the primary key
            $table->string('userTag', 15);
            $table->foreign('userTag')->references('userTag')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('announcementTitle', 255);
            $table->text('announcementContent');
            $table->string('announcementPic', 255)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcement');
    }
};
