<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteStore extends Model
{
    use HasFactory;

    protected $table = 'store_user_favorite';

    public function store()
    {
        return $this->belongsTo(Store::class, 'id', 'store_id');
    }

}
