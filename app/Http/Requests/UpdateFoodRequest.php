<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Food;

class UpdateFoodRequest extends FormRequest
{
    /**
     * ユーザーがこのリクエストを実行できるかどうかを判定します。
     * ユーザーが食品の所有者であれば更新を許可します。
     */
    public function authorize(): bool
    {
        // ルートパラメータから食品オブジェクトを取得
        $food = $this->route('food');

        // ユーザーがこの食品を更新できるかどうかを判定
        return $food && $this->user()->can('update', $food);
    }

    /**
     * リクエストに適用されるバリデーションルールを取得します。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 現在更新対象の食品のIDを取得
        $foodId = $this->route('food') ? $this->route('food')->id : null;

        return [
            // 名前は一意で、現在の食品のIDを除外
            'name' => 'required|string|max:255|unique:food,name,' . $foodId,
            'protein' => 'required|numeric|min:0',  // タンパク質は数値で0以上
            'carbs' => 'required|numeric|min:0',  // 炭水化物は数値で0以上
            'fat' => 'required|numeric|min:0',  // 脂肪は数値で0以上
            'grams' => 'required|numeric|min:0',  // グラムは数値で0以上
            'food_type_name' => 'nullable|string|exists:food_types,name',  // 食品タイプは存在する名前であること
        ];
    }
}