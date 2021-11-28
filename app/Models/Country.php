<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;


class Country extends Model
{
    use HasFactory;

    protected $table = 'countries';

    public static function getAll()
    {
        return Country::orderBy('name')->get();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
