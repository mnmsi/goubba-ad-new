<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteCategory extends Model
{
    use HasFactory;

    protected $table = 'user_category_interests';

    public function category()
    {
        return $this->belongsTo(Category::class, 'id', 'category_id');
    }

}
