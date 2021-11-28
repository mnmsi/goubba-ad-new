<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertisement;



class CadAdvertisementVideo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_video';

    protected $fillable = [
        'advertisement_id',
        'video_link',
        'referal_link',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function advertisement()
    {
        return $this->hasOne(CadAdvertisement::class);
    }
}
