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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('courier_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('landfill_id');
            $table->float('pickup_lat');
            $table->float('pickup_long');
            $table->float('weight');
            $table->integer('price');
            $table->enum('status', ['pending', 'accepted', 'completed', 'canceled']);
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('courier_id')->references('id')->on('couriers');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('landfill_id')->references('id')->on('landfills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
