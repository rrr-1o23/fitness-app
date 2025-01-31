<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class FoodSearchRequest extends FormRequest
{
    // authorizeメソッド。リクエストが許可されるかどうかを確認
    public function authorize(): bool
    {
        return true;
    }

    // rulesメソッド。リクエストに対するバリデーションルールを定義
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'food_type' => 'nullable|string|exists:food_types,name', // 存在するフードタイプ名かを確認
            'tags' => 'nullable|string'
        ];
    }
}