<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Users;
use App\Models\CadAdvertisementAnalyse;
use App\Models\Country;
use App\Models\City;
use App\Models\State;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public function advertisementAnalysis()
    {
        return $this->hasMany(CadAdvertisementAnalyse::class,'id', 'user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class,'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id', 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class,'state_id', 'id');
    }

    public function user_click()
    {
        return $this->hasOne(AdUserClick::class, 'user_id', 'id');
    }

}
