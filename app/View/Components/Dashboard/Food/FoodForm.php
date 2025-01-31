<?php

namespace App\View\Components\Dashboard\Food;

use App\Models\Food;
use App\Models\FoodType;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class FoodForm extends Component
{
    /**
     * フォームに必要なデータを管理するコンストラクタ。
     */
    public function __construct(
        public string $routeUrl,  // フォームの送信先URL
        public string $method,    // HTTPメソッド (POST, PUT など)
        public ?Food  $food = null,  // 編集時には既存の Food エントリ
    ){}

    /**
     * フォームに表示するためのビューを取得します。
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.food.food-form');
    }

    /**
     * フォームに表示する FoodType（食品の種類）をすべて取得します。
     */
    public function foodTypes(): Collection{
        return FoodType::all();
    }
}
