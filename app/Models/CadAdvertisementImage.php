<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertisement;



class CadAdvertisementImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_image';

    protected $fillable = [
        'advertisement_id',
        'image_link',
        'referal_link',
        'time_percent',
        'time_second', 
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function advertisement()
    {
        return $this->hasOne(CadAdvertisement::class);
    }
}
