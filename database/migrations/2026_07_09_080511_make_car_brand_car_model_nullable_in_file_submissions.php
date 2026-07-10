<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('file_submissions', function (Blueprint $table) {
            $table->string('car_brand')->nullable()->change();
            $table->string('car_model')->nullable()->change();
        });
    }
    public function down(): void {
        Schema::table('file_submissions', function (Blueprint $table) {
            $table->string('car_brand')->nullable(false)->change();
            $table->string('car_model')->nullable(false)->change();
        });
    }
};
