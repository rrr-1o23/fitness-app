<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodType;
use App\View\Components\Dashboard\FoodCards; // 新しいFoodCardsコンポーネントをインポート
use Illuminate\Database\Eloquent\Builder; // クエリビルダーの型指定を行うためにインポート
use Illuminate\Http\JsonResponse; // JSONレスポンスの型指定を行うためにインポート
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\View\View;

class DashboardController extends Controller implements HasMiddleware
{
    // ダッシュボードのホームページを表示するメソッド
    public function home(Request $request): View {
        return view('dashboard.home');
    }

    // 食品検索画面を表示するメソッド
    public function food(Request $request): View {
        // バリデーションルールを定義し、リクエストデータを検証
        $queryParams = $request->validate([
            'name' => 'nullable|string|max:255',
            'food_type' => 'nullable|string|exists:food_types,name', // food_typesテーブルに存在する名前か確認
            'tags' => 'nullable|string'
        ]);

        // 検索クエリを別のメソッドで処理するように変更
        $query = $this->foodSearchQuery($queryParams);

        // ページネーション付きで検索結果を表示
        return view('dashboard.food', [
            'foodTypes' => FoodType::all(),
            'food' => $query->orderByDesc('created_at')->paginate(10)->withQueryString(),
        ]);
    }

    // 新しく追加されたfoodSearchメソッド
    public function foodSearch(Request $request): JsonResponse {
        // リクエストデータを検証
        $data = $request->validate([
            'name' => 'nullable|string|max:255',
            'food_type' => 'nullable|string|exists:food_types,name',
            'tags' => 'nullable|string',
        ]);

        // 検索クエリを実行
        $query = $this->foodSearchQuery($data);

        // ページネーションとGETリンクを使用してデータを取得
        $foodPaginator = $query->orderByDesc('created_at')->paginate(perPage: 10)->withPath(route('dashboard.food'));

        // FoodCardsコンポーネントをインスタンス化し、ビューを生成
        $foodCardsComponent = new FoodCards($foodPaginator);
        $content = $foodCardsComponent->render()->with($foodCardsComponent->data())->render();

        // JSONレスポンスを返す
        return response()->json([
            'food' => $foodPaginator->items(), // 食品データをJSONとして返す
            'content' => $content, // ビューの内容もJSONとして返す
        ]);
    }

    // フィルタリングのためのクエリビルダーを生成するメソッド
    private function foodSearchQuery(array $data): Builder {
        $query = Food::query(); // Foodモデルのクエリビルダーを作成

        // 名前フィルタが指定されている場合
        if (!empty($data['name'])) {
            $query->where('name', 'like', '%' . $data['name'] . '%');
        }

        // フードタイプが指定されている場合
        if (!empty($data['food_type'])) {
            $query->whereHas('foodType', function($q) use ($data) {
                $q->where('name', $data['food_type']);
            });
        }

        // タグが指定されている場合
        if (!empty($data['tags'])) {
            $tags = array_map('trim', explode(',', $data['tags'])); // タグを配列に変換
            foreach ($tags as $tag) {
                $query->whereHas('foodTags', function($q) use ($tag) {
                    $q->where('name', $tag);
                });
            }
        }

        return $query; // フィルタリングされたクエリを返す
    }

    // ミドルウェアを設定
    public static function middleware(): array {
        return [
            'auth', // 認証済みユーザーのみがアクセス可能
            'verified' // メール確認済みのユーザーのみアクセス可能
        ];
    }
}