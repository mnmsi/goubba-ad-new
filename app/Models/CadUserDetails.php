<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CadUserDetails extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'cad_user_details';

    protected $fillable = [
        'user_id',
        'image',
        'phone',
        'website',
        'address',
        'bank_details',
        'key_contact_name',
        'key_contact_address',
        'key_contact_phone',
        'country',
        'city',
        'state',
        'created_at',
        'updated_at',
        'deleted_at',
    ];




    public function user()
    {
        return $this->belongsTo(CadUser::class, 'user_id', 'id');
    }


    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }



}
