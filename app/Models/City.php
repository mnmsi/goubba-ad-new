<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;


class City extends Model
{
    use HasFactory;

    protected $table = 'cities';

    public static function getAll()
    {
        return City::orderBy('name')->get();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
