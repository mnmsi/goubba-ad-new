<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\CadAdvertismentCampaign;



class CadAdvertisementCampaignType extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_campaign_type';

    protected $fillable = [
        'campaign_type_name',
        'campaign_type_id',
        'is_active', 
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public static function getAll()
    {
        return CadAdvertisementCampaignType::where('is_active', 1)
                ->select('campaign_type_name','campaign_type_id')
                ->get();
    }

    public function campaign()
    {
        return $this->belongsTo(CadAdvertismentCampaign::class,'campaign_type_id', 'campaign_type_id');
    }

}
