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
        Schema::create('food_food_tag', function (Blueprint $table) {
            $table->id(); // 自動インクリメントの主キー
            $table->timestamps(); // 作成日時と更新日時の自動管理
            $table->unsignedBigInteger('food_id'); // `food`テーブルへの外部キー
            $table->unsignedBigInteger('food_tag_id'); // `food_tags`テーブルへの外部キー

            // 外部キー制約
            $table->foreign('food_id')->references('id')->on('food')->onDelete('cascade');
            $table->foreign('food_tag_id')->references('id')->on('food_tags')->onDelete('cascade');

            // 食品とタグの組み合わせをユニークにする
            $table->unique(['food_id', 'food_tag_id']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_food_tag'); // テーブルを削除
    }
};
