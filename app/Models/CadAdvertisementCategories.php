<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertisement;



class CadAdvertisementCategories extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_categories';

    protected $fillable = [
        'advertisement_categories_name',
        'advertisement_category_id',
        'is_active',
        'deleted_at', 
        'created_at',
        'updated_at'
    ];

    public static function getAll()
    {
        return CadAdvertisementCategories::where('is_active', 1)
                ->select('advertisement_categories_name','advertisement_category_id')
                ->get();
    }

    public function advertisement()
    {
        return $this->hasMany(CadAdvertisement::class);
    }

}
