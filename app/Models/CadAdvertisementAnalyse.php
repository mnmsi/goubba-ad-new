<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\CadAdvertisement;
use App\Models\Users;


class CadAdvertisementAnalyse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_advertisement_analyse';

    protected $fillable = [
        'advertisement_id ',
        'user_id ',
        'link_clicks',
        'image_clicks',
        'watch_duration'
    ];

    public static function getById($id)
    {
        return CadAdvertisementAnalyse::with('advertisement','user', 'user.country','user.city','user.state')
                ->where('advertisement_id', $id)
                ->get();
    }

    public function advertisement()
    {
        return $this->belongsTo(CadAdvertisement::class);
    }

    public function user()
    {
        return $this->belongsTo(Users::class,'user_id','id');
    }
}
