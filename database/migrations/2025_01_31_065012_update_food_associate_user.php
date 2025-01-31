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
        Schema::table('food', function (Blueprint $table) {
            // ユーザーIDの外部キーを追加
            // NULL可能に設定し、ユーザーが削除された場合は食品も削除
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            // 外部キー制約とuser_idカラムを削除
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
};
