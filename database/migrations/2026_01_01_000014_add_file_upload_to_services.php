<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->boolean('file_upload_enabled')->default(false)->after('active');
            $table->string('file_types')->nullable()->after('file_upload_enabled')
                  ->comment('Comma-separated file type labels, e.g. ECU File,Gearbox File');
        });
    }
    public function down(): void {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['file_upload_enabled', 'file_types']);
        });
    }
};
