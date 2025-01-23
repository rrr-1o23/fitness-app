<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodTag extends Model
{
    /** @use HasFactory<\Database\Factories\FoodTagFactory> */
    use HasFactory;

    protected $guarded = []; // 全カラムをマスアサインメント可能にします

    // Foodとの多対多関係
    public function food(): BelongsToMany{
        return $this->belongsToMany(Food::class)->withTimestamps();
    }

}
