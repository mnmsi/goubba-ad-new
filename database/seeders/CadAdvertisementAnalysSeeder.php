<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CadAdvertisement;
use App\Models\CadAdvertisementAnalyse;

class CadAdvertisementAnalysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = [
            ['advertisement_id ' => 4,'user_id ' => 3,'link_clicks' => 1,'image_clicks' => 5,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 5,'user_id ' => 4,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 6,'user_id ' => 5,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 7,'user_id ' => 6,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36', ],
            // ['advertisement_id ' => 4,'user_id ' => 8,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 5,'user_id ' => 9,'link_clicks' => 0,'image_clicks' => 8,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 6,'user_id ' => 10,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 7,'user_id ' => 14,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36', ],
            // ['advertisement_id ' => 4,'user_id ' => 17,'link_clicks' => 1,'image_clicks' => 17,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 5,'user_id ' => 19,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 6,'user_id ' => 20,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 7,'user_id ' => 21,'link_clicks' => 0,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36', ],
            // ['advertisement_id ' => 4,'user_id ' => 22,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 5,'user_id ' => 23,'link_clicks' => 1,'image_clicks' => 25,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 6,'user_id ' => 30,'link_clicks' => 0,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 7,'user_id ' => 31,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36', ],
            // ['advertisement_id ' => 4,'user_id ' => 32,'link_clicks' => 0,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 5,'user_id ' => 33,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 6,'user_id ' => 36,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36'],
            // ['advertisement_id ' => 7,'user_id ' => 37,'link_clicks' => 1,'image_clicks' => 1,'watch_duration' => '00:35:36','created_at' => '2020-12-08 13:35:36' ]
        ];

        foreach ($types as $key => $value) {
            CadAdvertisementAnalyse::updateOrCreate($value);
        }

    }
}
