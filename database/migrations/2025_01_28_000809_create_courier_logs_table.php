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
        Schema::create('courier_logs', function (Blueprint $table) {
            $table->id();
            // $table->foreignId('courier_id')->constrained()->onDelete('cascade')->onUpdate();
            $table->unsignedBigInteger('courier_id');
            $table->string('email');
            $table->string('name');
            $table->date('birthdate');
            $table->enum('gender', ['L', 'P']);
            $table->string('phone');
            $table->string('address');
            $table->string('city');
            $table->string('plate_number');
            // $table->date('deleted_at');
            $table->timestamps();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courier_logs');
    }
};
