<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * データベースシードを実行します。
     * この関数内で、データベースに初期データを挿入するための処理を行います。
     */
    public function run(): void
    {
        // config()関数を使用して、シーディングに必要な設定を取得
        // 'models.seeding.food'でconfig/models/seeding/food.phpの設定を参照
        $seedConfig = config('models.seeding.food');
        // 設定ファイルから、デフォルトの食品項目のリストを取得
        $foodItems = $seedConfig['default_list'];

        // 取得した食品項目リストをループして、データベースに挿入または更新
        foreach ($foodItems as $foodItem) {
            // FoodモデルのupdateOrCreate()メソッドを使用して、
            // 同じ名前の食品が存在する場合は更新、存在しない場合は新規作成
            Food::updateOrCreate(
                [
                    'name' => $foodItem['name'], // 検索条件:'name'カラムを指定
                    // 見つかった場合はそのデータを更新し、見つからなかった場合は新しいデータを作成
                    // ここでは、食品の名前を検索条件にして、データベースに食品データを挿入または更新
                ],
                [
                    //マスアサインメントで指定するデータ
                    'protein' => $foodItem['protein'], // 'protein'カラムにデータを挿入
                    'carbs' => $foodItem['carbs'],     // 'carbs'カラムにデータを挿入
                    'fat' => $foodItem['fat'],         // 'fat'カラムにデータを挿入
                    'grams' => $foodItem['grams'],       // 'grams'カラムを追加したい場合はここに記述できます
                ]
            );
        }

        // コンフィグから、ファクトリを使用するかどうかの設定を取得
        $useFactory = $seedConfig['factory'];
        // コンフィグから、ファクトリで生成する項目の数を取得
        $factoryCount = $seedConfig['factory_count'];

        // ファクトリを使用する設定がtrueの場合
        if ($useFactory) {
            // Foodファクトリを使用して、指定した数のランダムな食品データを作成し、データベースに保存
            Food::factory()->count($factoryCount)->create();
        }
    }
}