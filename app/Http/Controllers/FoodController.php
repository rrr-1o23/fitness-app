<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\Food;
use Illuminate\Support\Facades\Blade;

class FoodController extends Controller
{
    /**
     * 全ての食品項目を表示します。
     */
    public function index()
    {
        return Blade::render(
            // ダッシュボードレイアウトを使って、ユーザーが作成した食品を表示
            <<<'blade'
            <x-dashboard-layout>
                <div id="food-cards" class="food-card-container">
                    <x-dashboard.food-cards :food-paginator="$food">
                    </x-dashboard.food-cards>

                    <div class="flex justify-center items-center">
                        <a href="{{ route('food.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Create Food Items
                        </a>
                    </div>
                </div>
            </x-dashboard-layout>
            blade,
            [
                // ログイン中のユーザーが作成した食品をページネーション付きで取得
                'food' => auth()->user()->food()->orderByDesc('created_at')->paginate(10),
            ]
        );
    }

    /**
     * 新しい食品項目を作成するフォームを表示します。
     */
    public function create()
    {
        return Blade::render(
            <<<'blade'
                <x-dashboard-layout>
                    <x-dashboard.food.food-form :route-url="$route" method="POST">
                    </x-dashboard.food.food-form>
                </x-dashboard-layout>
            blade,
            [
                // 新しい食品を作成するルートを指定
                'route' => route('food.store'),
            ]
        );
    }

    /**
     * 新しい食品項目を保存します。
     */
    public function store(StoreFoodRequest $request)
    {
        // フォームのバリデーションを通過したデータで新しい食品を作成
        $food = auth()->user()->food()->create($request->validated());

        // 作成した食品の詳細ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('food.show',$food)->with(['success'=>json_encode($request->validated())]);
    }

    /**
     * 指定された食品項目を表示します。
     */
    public function show(Food $food)
    {
        return Blade::render(
            <<<'blade'
                <x-dashboard-layout>
                    <x-cards.food-item-card :food="$foodItem" color="blue">
                        <div class="flex justify-center items-center mb-3">
                            <a href="{{ route('food.edit', $foodItem) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Edit Food Item
                            </a>
                        </div>
                        <div class="flex justify-center items-center">
                            <form action="{{ route('food.destroy', $foodItem) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white font-bold py-2 px-4 rounded">
                                    Delete This Food
                                </button>
                            </form>
                        </div>
                    </x-cards.food-item-card>
                </x-dashboard-layout>
            blade,
            [
                // 表示する食品データをBladeに渡す
                'foodItem' => $food
            ]
        );
    }

    /**
     * 指定された食品項目の編集フォームを表示します。
     */
    public function edit(Food $food)
    {
        return Blade::render(
            <<<'blade'
                <x-dashboard-layout>
                    <x-dashboard.food.food-form :route-url="$route" method="PUT" :food="$foodItem">
                    </x-dashboard.food.food-form>
                </x-dashboard-layout>
            blade,
            [
                // 更新用のルートと編集する食品データを渡す
                'route' => route('food.update', $food),
                'foodItem'=> $food
            ]
        );
    }

    /**
     * 指定された食品項目を更新します。
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        // フォームのバリデーションを通過したデータで食品を更新
        $food->update($request->validated());

        // 更新した食品の詳細ページにリダイレクトし、成功メッセージを表示
        return redirect()->route('food.show',$food)->with(['success'=>json_encode($request->validated())]);
    }

    /**
     * 指定された食品項目を削除します。
     */
    public function destroy(Food $food)
    {
        // ユーザーが食品を削除できるかどうか確認
        if(auth()->user()->can('delete', $food)){
            $food->delete();

            // 食品の一覧ページにリダイレクトし、削除成功メッセージを表示
            return redirect()->route('food.index')->with(['success'=>'Successfully deleted Food Item']);
        }
        else {
            // 認可がない場合はエラーメッセージを表示して元のページに戻る
            return redirect()->back()->withErrors(['denied'=>'access denied']);
        }
    }
}