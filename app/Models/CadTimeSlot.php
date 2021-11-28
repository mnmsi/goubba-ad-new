<?php

namespace App\Models;
use App\Models\CadAdvertisement;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadTimeSlot extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cad_time_slot';

    protected $fillable = [
        'advertisement_id',
        'start_time',
        'end_time',
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    public function advertisement()
    {
        return $this->hasOne(CadAdvertisement::class);
    }

}
