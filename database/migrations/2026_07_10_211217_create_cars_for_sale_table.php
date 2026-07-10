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
        Schema::create('cars_for_sale', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price', 15, 2);
            $table->integer('mileage');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->string('engine_size')->nullable();
            $table->string('color')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->text('gallery')->nullable(); // JSON array
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars_for_sale');
    }
};
