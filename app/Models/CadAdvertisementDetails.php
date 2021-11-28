<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertisement;


class CadAdvertisementDetails extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_details';

    protected $fillable = [
        'advertisement_id',
        'min_age',
        'max_age',
        'age_range',
        'country_id',
        'city_id',
        'state_id',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function advertisement()
    {
        return $this->belongsTo(CadAdvertisement::class);
    }

}
