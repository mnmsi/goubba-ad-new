<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdUserClick extends Model
{
    use HasFactory;

    protected $table = 'cad_users_click';

    protected $fillable = [
        'ad_id',
        'user_id',
    ];

    public static function getTotalUserClicks($campId = null)
    {
        if (!is_array($campId)) {
            $ads = CadAdvertisement::getAdvByCamp($campId);
            $ads = $ads->pluck('id')->toArray();

        } else {
            $ads = CadAdvertisement::whereIn('campaign_id', $campId)->pluck('id')->toArray();
        }

        return AdUserClick::whereIn('ad_id', $ads)->count();
    }

    public static function getClicksUser($campId = null, $pagination = false)
    {
        if (!is_array($campId)) {
            $ads = CadAdvertisement::getAdvByCamp($campId);
            $ads = $ads->pluck('id')->toArray();

        } else {
            $ads = CadAdvertisement::whereIn('campaign_id', $campId)->pluck('id')->toArray();
        }

        if ($pagination) {
            return AdUserClick::whereIn('ad_id', $ads)
                ->with('user')
                ->select('user_id')
                ->distinct()
                ->paginate(15);

        } else {

            return AdUserClick::whereIn('ad_id', $ads)
                ->with('user')
                ->select('user_id')
                ->distinct()
                ->get();
        }
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id', 'id');
    }
}
