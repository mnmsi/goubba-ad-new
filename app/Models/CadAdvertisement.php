<?php

namespace App\Models;

use App\Models\CadAdvertisementAnalyse;
use App\Models\CadAdvertisementCategories;
use App\Models\CadAdvertisementDetails;
use App\Models\CadAdvertisementType;
use App\Models\CadAdvertismentCampaign;
use App\Models\CadImpression;
use App\Models\CadTimeSlot;
use App\Models\CadUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadAdvertisement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'brand_title',
        'brand_logo',
        'campaign_id',
        'category_id',
        'type_id',
        'user_id',
        'title',
        'desc',
        'adv_type',
        'adv_position',
        'feed_adv_type',
        'rewards_amount',
        'budget',
        'favorite_store_ids',
        'favorite_category_ids',
        'start_date',
        'end_date',
        'is_active',
        'deleted_at',
        'created_at',
        'updated_at',
    ];

    public static function getById($id, $userId)
    {
        if ($userId == 1) {
            $advertisement = CadAdvertisement::with('advertisementType', 'advertisementCategory', 'timeSlot', 'user', 'advertisementImage', 'advertisementVideo', 'advertisementDetails')
                ->find($id);
        } else {
            $advertisement = CadAdvertisement::with('advertisementType', 'advertisementCategory', 'timeSlot', 'user', 'advertisementImage', 'advertisementVideo', 'advertisementDetails')
                ->where('user_id', $userId)
                ->find($id);
        }
        return $advertisement;
    }

    /**
     *
     * Get all advertisement based On User id
     * If admin it will fetch all advertisement
     * If user it will only fetch the advertisement belongs to user
     *
     */
    public static function getAll($userId)
    {
        if ($userId == 1) {
            $advertisement = CadAdvertisement::with('advertisementType', 'advertisementCategory', 'timeSlot', 'user')->get();
        } else {
            $advertisement = CadAdvertisement::with('advertisementType', 'advertisementCategory', 'timeSlot', 'user')
                ->where('user_id', $userId)
                ->get();
        }
        return $advertisement;
    }

    public static function getAdvByCamp($campId)
    {
        return CadAdvertisement::where('campaign_id', $campId)->get();
    }

    /**
     *
     * Checking a time slot is available for user
     *
     */
    public static function checkAvailableTimeSlot($uid, $start_date, $end_date, $start_time, $end_time)
    {

        return CadAdvertisement::whereHas('timeslot', function ($timeSlot) use ($start_time, $end_time) {
            $timeSlot->whereBetween('start_time', [$start_time, $end_time])
                ->orWhereBetween('end_time', [$start_time, $end_time]);
        })->with('timeSlot')
            ->whereBetween('start_date', [$start_date, $end_date])
            ->orWhereBetween('end_date', [$start_date, $end_date])
            ->where('user_id', '!=', $uid)
            ->orWhereNull('user_id')
            ->get();
    }

    public static function getNativePosition()
    {
        $carbon  = Carbon::now();
        $getDate = $carbon->toDateString();

        return CadAdvertisement::
            select('adv_position')
            ->where('start_date', $getDate)
            ->get();
    }

    public function CadAdvertismentCampaign()
    {
        return $this->belongsTo(CadAdvertismentCampaign::class, 'campaign_id', 'campaign_type_id');
    }

    public function advertisementCategory()
    {
        return $this->belongsTo(CadAdvertisementCategories::class, 'category_id', 'advertisement_category_id');
    }

    public function advertisementType()
    {
        return $this->belongsTo(CadAdvertisementType::class, 'type_id', 'advertisment_type_id');
    }

    // public function advertisementImage()
    // {
    //     return $this->hasMany(CadAdvertisementImage::class,'advertisement_id','id');
    // }

    // public function advertisementVideo()
    // {
    //     return $this->hasMany(CadAdvertisementVideo::class,'advertisement_id','id');
    // }

    public function advertisementMedia()
    {
        return $this->hasMany(CadAdvertisementMedia::class, 'advertisement_id', 'id');
    }

    public function advertisementDetails()
    {
        return $this->belongsTo(CadAdvertisementDetails::class, 'id', 'advertisement_id');
    }

    public function advertisementAnalysis()
    {
        return $this->hasMany(CadAdvertisementAnalyse::class, 'advertisement_id', 'id');
    }

    public function impression()
    {
        return $this->belongsTo(CadImpression::class, 'id', 'advertisement_id');
    }

    public function user()
    {
        return $this->belongsTo(CadUser::class, 'user_id');
    }

    public function campain()
    {
        return $this->belongsTo(CadAdvertismentCampaign::class, 'campaign_id', 'id');
    }

    public function timeSlot()
    {
        return $this->hasOne(CadTimeSlot::class, 'advertisement_id', 'id');
    }

    public function delete()
    {
        $this->advertisementDetails()->delete();
        $this->timeSlot()->delete();
        $this->impression()->delete();
        $this->advertisementMedia()->delete();

        return parent::delete();
    }
}
