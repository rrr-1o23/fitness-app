<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Food extends Model
{
    use HasFactory;
    use SoftDeletes;

    // プロパティ保護
    protected $guarded = [];

    // リレーションシップ：食品は特定のFoodTypeに属する
    public function foodType(): BelongsTo {
        return $this->belongsTo(FoodType::class);
    }

    // リレーションシップ：食品は複数のタグを持つ
    public function foodTags(): belongsToMany {
        return $this->belongsToMany(FoodTag::class)->withTimestamps();
    }

    // リレーションシップ：食品は特定のユーザーに属する
    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    // 総カロリー計算メソッド
    public function getTotalCalories(): float {
        return ($this->protein * 4) + ($this->carbs * 4) + ($this->fat * 9);
    }
}
