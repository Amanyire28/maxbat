<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('file_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('car_brand');
            $table->string('car_model');
            $table->string('chassis_no');
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->string('file_type');
            $table->string('file_path');
            $table->string('original_filename');
            $table->string('file_size')->nullable();
            $table->text('notes')->nullable();
            $table->enum('status', ['new','reviewing','completed','rejected'])->default('new');
            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('file_submissions'); }
};
