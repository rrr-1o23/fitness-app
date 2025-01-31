<?php

namespace App\Http\Controllers;

use App\Http\Requests\Dashboard\FoodSearchRequest; // FormRequestクラスをインポート
use App\Models\Food;
use App\Models\FoodType;
use App\View\Components\Dashboard\FoodCards;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class DashboardController extends Controller implements HasMiddleware
{

    public function home(Request $request): View{
        return view('dashboard.home');
    }

    // 食品検索画面を表示するメソッド。リクエストバリデーションにFoodSearchRequestを利用
    public function food(FoodSearchRequest $request): View {
        $query = $this->foodSearchQuery($request->toArray());

        return view('dashboard.food', [
            'foodTypes' => FoodType::all(),
            'food' => $query->orderByDesc('created_at')->paginate(10)->withQueryString(),
        ]);
    }

    // 食品検索結果をJSONで返すメソッド。FormRequestを使用
    public function foodSearch(FoodSearchRequest $request): JsonResponse {
        $query = $this->foodSearchQuery($request->toArray());

        $foodPaginator = $query->orderByDesc('created_at')->paginate(perPage: 10)->withPath(route('dashboard.food'));

        $foodCardsComponent = new FoodCards($foodPaginator);

        $content = $foodCardsComponent->render()->with($foodCardsComponent->data())->render();

        return response()->json([
            'food' => $foodPaginator->items(),
            'content' => $content,
        ]);
    }

    private function foodSearchQuery(array $data): Builder
    {
        $query = Food::query();

        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        if (!empty($data['food_type'])) {
            $query->whereHas('foodType', function($q) use ($data) {
                $q->where('name', $data['food_type']);
            });
        }

        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags']));
            foreach ($tags as $tag) {
                $query->whereHas('foodTags', function($q) use ($tag) {
                    $q->where('name', $tag);
                });
            }
        }

        return $query;
    }

    public static function middleware(): array
    {
        return [
            'auth',
            'verified'
        ];
    }
}