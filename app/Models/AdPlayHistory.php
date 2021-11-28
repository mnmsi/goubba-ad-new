<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdPlayHistory extends Model
{
    use HasFactory;

    protected $table = 'cad_play_history';

    protected $fillable = [
        'ad_id',
        'impression_used',
        'impression_left',
    ];

    public static function getTotalUserViews($campId = null)
    {
        if (!is_array($campId)) {
            $ads = CadAdvertisement::getAdvByCamp($campId);

            $ads = $ads->pluck('id')->toArray();
        } else {
            $ads = CadAdvertisement::whereIn('campaign_id', $campId)->pluck('id')->toArray();
        }

        return AdPlayHistory::whereIn('ad_id', $ads)->count();
    }
}
