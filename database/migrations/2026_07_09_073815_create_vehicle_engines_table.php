<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vehicle_engines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_model_id')->constrained()->cascadeOnDelete();
            $table->string('name');        // e.g. "2.0T 184hp", "3.0d 286hp"
            $table->string('displacement')->nullable(); // e.g. "2.0L"
            $table->string('power')->nullable();        // e.g. "184hp / 135kW"
            $table->string('fuel_type')->nullable();    // Petrol, Diesel, Hybrid, Electric
            $table->boolean('active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vehicle_engines'); }
};
