<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('vehicle_make')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('service')->nullable();
            $table->text('message')->nullable();
            $table->enum('status', ['new', 'in_progress', 'completed', 'cancelled'])->default('new');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('inquiries'); }
};
