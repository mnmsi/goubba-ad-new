<?php

namespace App\Models;

use App\Models\CadAdvertisement;
use App\Models\CadAdvertisementCampaignType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadAdvertismentCampaign extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisment_campaign';

    protected $fillable = [
        'user_id',
        'campaign_name',
        'budget',
        'campaign_type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getById($id, $userId)
    {
        if ($userId == 1) {
            $campaign = CadAdvertismentCampaign::with('campaign_type', 'advertisement', 'advertisement.advertisementCategory', 'advertisement.timeSlot', 'advertisement.user', 'advertisement.advertisementMedia', 'advertisement.advertisementDetails', 'advertisement.impression')->find($id);
        } else {
            $campaign = CadAdvertismentCampaign::with('campaign_type', 'advertisement', 'advertisement.advertisementCategory', 'advertisement.timeSlot', 'advertisement.user', 'advertisement.advertisementMedia', 'advertisement.advertisementDetails')
                ->where('user_id', $userId)
                ->find($id);
        }
        return $campaign;
    }

    public static function getAll($userId, $paginate = false)
    {
        if ($userId == 1) {
            $campaign = CadAdvertismentCampaign::with('advertisement');
        } else {
            $campaign = CadAdvertismentCampaign::with('advertisement')
                ->where('user_id', $userId);
        }

        if (!$paginate) {
            $campaign = $campaign->get();
        } else {
            $campaign = $campaign->paginate(10);
        }

        return $campaign;
    }

    public function advertisement()
    {
        return $this->hasMany(CadAdvertisement::class, 'campaign_id', 'id');
    }

    // public function user()
    // {
    //     return $this->belongsTo(CadUser::class, 'user_id', 'id');
    // }

    public function campaign_type()
    {
        return $this->hasOne(CadAdvertisementCampaignType::class, 'campaign_type_id', 'campaign_type_id');
    }

}
