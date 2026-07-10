<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        // Fix chat_rooms — add missing columns
        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->after('id');
            $table->timestamp('last_message_at')->nullable()->after('user_id');
        });

        // Fix chat_messages — add missing columns
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->foreignId('chat_room_id')->constrained()->cascadeOnDelete()->after('id');
            $table->enum('sender_type', ['admin', 'customer'])->after('chat_room_id');
            $table->foreignId('sender_id')->constrained('users')->cascadeOnDelete()->after('sender_type');
            $table->text('body')->after('sender_id');
            $table->timestamp('read_at')->nullable()->after('body');
        });
    }

    public function down(): void {
        Schema::table('chat_messages', function (Blueprint $table) {
            $table->dropConstrainedForeignId('chat_room_id');
            $table->dropConstrainedForeignId('sender_id');
            $table->dropColumn(['sender_type', 'body', 'read_at']);
        });
        Schema::table('chat_rooms', function (Blueprint $table) {
            $table->dropConstrainedForeignId('user_id');
            $table->dropColumn('last_message_at');
        });
    }
};
