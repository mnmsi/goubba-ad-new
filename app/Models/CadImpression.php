<?php

namespace App\Models;
use App\Models\CadAdvertisement;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadImpression extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_impression';

    protected $fillable = [
        'advertisement_id',
        'daily_impression',
        'lifetime_impression',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function advertisement()
    {
        return $this->hasOne(CadAdvertisement::class, 'id', 'advertisement_id');
    }

}
