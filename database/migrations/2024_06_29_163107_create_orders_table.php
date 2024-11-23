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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('service_id');
            $table->integer('user_id');
            $table->integer('sprovider_id')->nullable();
            $table->string('order_code');
            $table->decimal('lat',20,10);
            $table->decimal('lon',20,10);
            $table->string('country')->default('السودان');
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('street')->nullable();
            $table->string('suburb')->nullable();
            $table->integer('postcode')->nullable();
            $table->date('time');
            $table->string('details')->nullable();
            $table->integer('status')->default('0');
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
