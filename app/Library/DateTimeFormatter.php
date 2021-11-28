<?php

namespace App\Library;
use Carbon\Carbon;


class DateTimeFormatter
{   
    /***
     * 
     * @param
     *  @startDate date
     *  @endDate date
     *  @startTime time
     *  @endTime time
     *
     * @return integer
     * 
    */
    public static function getTimeDifference($startDate, $endDate, $startTime, $endTime)
    {
        $start  = new Carbon($startDate. ' '. $startTime);
        $end    = new Carbon($endDate. ' '. $endTime);

        $diff = $start->diffInSeconds($end);

        return $diff;
    }

}