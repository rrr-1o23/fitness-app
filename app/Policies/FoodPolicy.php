<?php

namespace App\Policies;

use App\Models\Food;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FoodPolicy
{
    /**
     * すべての食品エントリーを閲覧できるかの判定
     */
    public function viewAny(User $user): bool
    {
        // すべてのユーザーが食品エントリーを閲覧可能
        return true;
    }

    /**
     * 特定の食品エントリーを閲覧できるかの判定
     */
    public function view(User $user, Food $food): bool
    {
        // すべてのユーザーが特定の食品エントリーを閲覧可能
        return true;
    }

    /**
     * 新しい食品エントリーを作成できるかの判定
     */
    public function create(User $user): bool
    {
        // すべてのユーザーが新しいエントリーを作成可能
        return true;
    }

    /**
     * 食品エントリーを更新できるかの判定
     */
    public function update(User $user, Food $food): bool
    {
        // エントリーを作成したユーザーのみ更新可能
        return $user->id === $food->user_id;
    }

    /**
     * 食品エントリーを削除できるかの判定
     */
    public function delete(User $user, Food $food): bool
    {
        // エントリーを作成したユーザーのみ削除可能
        return $user->id === $food->user_id;
    }

    /**
     * 食品エントリーを復元できるかの判定
     */
    public function restore(User $user, Food $food): bool
    {
        // エントリーを作成したユーザーのみ復元可能
        return $user->id === $food->user_id;
    }

    /**
     * 食品エントリーを完全に削除できるかの判定
     */
    public function forceDelete(User $user, Food $food): bool
    {
        // エントリーを作成したユーザーのみ完全削除可能
        return $user->id === $food->user_id;
    }
}