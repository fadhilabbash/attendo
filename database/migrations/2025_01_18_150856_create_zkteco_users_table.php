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
        Schema::create('zkteco_users', function (Blueprint $table) {
            $table->id();
            $table->integer('uid')->unique(); // Device-specific unique ID
            $table->string('user_id', 9)->unique(); // Database User ID (max length = 9)
            $table->string('device_name', 24); // User's name (max length = 24)
            $table->string('real_name', 24)->nullable(); // User's name (max length = 24)
            $table->string('password', 8)->nullable(); // User's password (max length = 8)
            $table->integer('role')->default(1); // Role (default: User)
            $table->string('card_no', 10)->nullable(); // Card number
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zkteco_users');
    }
};
