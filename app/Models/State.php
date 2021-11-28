<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;

class State extends Model
{
    use HasFactory;

    protected $table = 'states';

    public static function getAll()
    {
        return State::orderBy('name')->get();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
