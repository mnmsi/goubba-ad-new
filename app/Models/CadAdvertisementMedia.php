<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

use App\Models\CadAdvertisementCategories;
use App\Models\CadAdvertismentCampaign;
use App\Models\CadAdvertisementType;
use App\Models\CadAdvertisementImage;
use App\Models\CadAdvertisementVideo;
use App\Models\CadAdvertisementDetails;
use App\Models\CadAdvertisementAnalyse;
use App\Models\CadImpression;
use App\Models\CadUser;
use App\Models\CadTimeSlot;

class CadAdvertisementMedia extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_media';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'advertisement_id',
        'media_type',
        'media_link',
        'referal_link',
        'time_percent',
        'time_percent_to_second',
        'position',
        'play_time',
        'reward',
        'ad_type',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function advertisement()
    {
        return $this->hasOne(CadAdvertisement::class);
    }
}
