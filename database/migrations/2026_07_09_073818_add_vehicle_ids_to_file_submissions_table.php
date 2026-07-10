<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('file_submissions', function (Blueprint $table) {
            // Replace free-text car_brand / car_model with structured FKs
            // Keep old columns nullable for backward compat, add new FK columns
            $table->foreignId('vehicle_type_id')->nullable()->constrained()->nullOnDelete()->after('chassis_no');
            $table->foreignId('vehicle_brand_id')->nullable()->constrained()->nullOnDelete()->after('vehicle_type_id');
            $table->foreignId('vehicle_series_id')->nullable()->constrained()->nullOnDelete()->after('vehicle_brand_id');
            $table->foreignId('vehicle_model_id')->nullable()->constrained()->nullOnDelete()->after('vehicle_series_id');
            $table->foreignId('vehicle_engine_id')->nullable()->constrained()->nullOnDelete()->after('vehicle_model_id');
        });
    }
    public function down(): void {
        Schema::table('file_submissions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('vehicle_type_id');
            $table->dropConstrainedForeignId('vehicle_brand_id');
            $table->dropConstrainedForeignId('vehicle_series_id');
            $table->dropConstrainedForeignId('vehicle_model_id');
            $table->dropConstrainedForeignId('vehicle_engine_id');
        });
    }
};
