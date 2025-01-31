<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Food;

class StoreFoodRequest extends FormRequest
{
    /**
     * このリクエストを実行できるかどうかを判定します。
     * FoodPolicyのcreateメソッドを利用して、ユーザーが食品を作成できるかをチェック。
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Food::class);
    }

    /**
     * リクエストに適用されるバリデーションルールを取得します。
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:food,name', // 名前は必須で、ユニークな値
            'protein' => 'required|numeric|min:0', // タンパク質は必須で数値
            'carbs' => 'required|numeric|min:0', // 炭水化物は必須で数値
            'fat' => 'required|numeric|min:0', // 脂肪は必須で数値
            'grams' => 'required|numeric|min:0', // グラムは必須で数値
            'food_type_name' => 'nullable|string|exists:food_types,name', // 食品タイプが存在するかチェック
        ];
    }
}