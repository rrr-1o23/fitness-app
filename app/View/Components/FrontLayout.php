<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

// このクラスは、Bladeコンポーネントとして機能するためのクラスです。
// FrontLayoutという名前のレイアウトコンポーネントを作成しています。
class FrontLayout extends Component
{
    /**
     * 新しいコンポーネントインスタンスを作成します。
     * コンストラクタはコンポーネントが生成される際に最初に実行されます。
     * ここで、コンポーネントの初期化処理が行われますが、今回は特に処理は行っていません。
     */
    public function __construct()
    {
        // 初期化処理が必要な場合はここに記述します。
    }

    /**
     * このコンポーネントを表すビュー/コンテンツを取得します。
     * renderメソッドは、このコンポーネントがどのビュー（Bladeテンプレート）を使用するかを指定します。
     * 
     * @return View|Closure|string このコンポーネントのビューを返します。
     */
    public function render(): View|Closure|string
    {
        // 'layouts.front' という名前のビュー（Bladeテンプレート）を使用することを指定しています。
        // 'layouts/front.blade.php'というファイルが使われることになります。
        return view('layouts.front');
    }
}