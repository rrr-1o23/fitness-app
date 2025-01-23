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
            // foodテーブルにfood_type_nameという名前の新しいカラムを追加します。
            // このカラムは文字列型（string）で、nullを許可しています。
            $table->string('food_type_name')->nullable();

            // 先ほど追加したfood_type_nameカラムを外部キーとして設定します。
            // 具体的には、このカラムはfood_typesテーブルのnameカラムを参照します。
            // food_typesテーブルで関連する行が削除されたときに、自動的にfoodテーブルの対応する行も削除されます。
            // たとえば、Fruitsという名前のFoodTypeが削除された場合、
            // それに関連するすべての食品（例えばオレンジやバナナなど）も自動的に削除されます。
            $table->foreign('food_type_name')->references('name')->on('food_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('food', function (Blueprint $table) {
            $table->dropForeign(['food_type_name']);
            $table->dropColumn('food_type_name');
        });
    }
};
