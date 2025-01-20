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
        Schema::create('couriers', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable()->defaultValue(null);
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->date('birthdate')->nullable()->defaultValue(null);
            $table->enum('gender', ['L', 'P']);
            $table->string('phone')->nullable()->defaultValue(null);
            $table->string('address')->nullable()->defaultValue(null);
            $table->string('city')->nullable()->defaultValue(null);
            $table->string('plate_number')->nullable()->defaultValue(null);
            $table->enum('status', ['Aktif', 'Nonaktif']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('couriers');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
