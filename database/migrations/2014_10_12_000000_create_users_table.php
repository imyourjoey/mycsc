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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('userTag',15)->unique();
            $table->string('icNum',15)->nullable();
            $table->string('email')->unique();
            $table->string('phoneNo',255);
            $table->string('password', 60);
            $table->string('role', 15);
            $table->string('oneTimePin', 255)->nullable();
            $table->boolean('emailVerified')->nullable()->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
