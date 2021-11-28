<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'coupons';

    public static function getAll()
    {
        $carbon         = Carbon::now();
        $getDate        = $carbon->toDateString();
        return Coupon::where('code','!=','')
            ->where('type', 'code')
            ->whereDate('start', '=', $getDate)
            // ->orWhereBetween('end_date', [$start_date,$end_date])
            // ->select('advertisement_categories_name','advertisement_category_id')
            ->count();
    
    }

}
