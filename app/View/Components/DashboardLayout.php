<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DashboardLayout extends Component
{
    /**
     * コンポーネントの新しいインスタンスを作成します。
     */
    public function __construct()
    {
        // 必要に応じて初期化処理を記述
    }

    /**
     * このコンポーネントを表すビュー/コンテンツを取得します。
     */
    public function render(): View|Closure|string
    {
        return view('layouts.dashboard');
    }
}