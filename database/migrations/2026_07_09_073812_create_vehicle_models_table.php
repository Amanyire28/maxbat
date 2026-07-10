<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vehicle_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_series_id')->constrained()->cascadeOnDelete();
            $table->string('name');        // e.g. "320i", "320d", "Land Cruiser 200"
            $table->string('year_range')->nullable(); // e.g. "2015-2023"
            $table->boolean('active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vehicle_models'); }
};
