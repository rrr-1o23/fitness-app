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
        Schema::create('food_tags', function (Blueprint $table) {
            $table->id(); // 自動インクリメントのプライマリキー
            $table->string('name')->unique(); // タグ名はユニーク
            $table->string('description'); // タグの説明
            $table->timestamps(); // 作成日時と更新日時を自動管理
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_tags'); // テーブルを削除
    }
};
