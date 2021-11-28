<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CadUserRole extends Model
{
    use HasFactory;

    protected $table = 'cad_user_role';
    protected $fillable = ['role_name', 'role_id', 'is_active', ];

    public static function getAll()
    {
        return CadUserRole::all();
    }



}
