<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('vehicle_series', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicle_brand_id')->constrained()->cascadeOnDelete();
            $table->string('name');        // e.g. "3 Series", "Land Cruiser", "C-Class"
            $table->boolean('active')->default(true);
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('vehicle_series'); }
};
