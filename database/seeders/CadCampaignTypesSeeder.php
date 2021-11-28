<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CadAdvertisementCampaignType;


class CadCampaignTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Campaign = [
            [
                'campaign_type_name' => 'Awareness',
                'campaign_type_id' => 1,
                'is_active' => 1,
            ],
            [
                'campaign_type_name' => 'Reward Engagement',
                'campaign_type_id' => 2,
                'is_active' => 1,
            ],
            [
                'campaign_type_name' => 'Reward Conversions',
                'campaign_type_id' => 3,
                'is_active' => 1,
            ]
        ];

        foreach ($Campaign as $key => $value) {
            CadAdvertisementCampaignType::updateOrCreate($value);
        }
    }
}
