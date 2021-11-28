<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertisement;


class CadAdvertisementType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_type';

    protected $fillable = [
        'advertisement_type_name',
        'advertisment_type_id',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public static function getAll()
    {
        return  DB::table('cad_advertisement_type')
            ->select('cad_advertisement_type.*')
            ->where('is_active', 1)
            ->get();
    }

    public function advertisement()
    {
        return $this->hasMany(CadAdvertisement::class);
    }

}
