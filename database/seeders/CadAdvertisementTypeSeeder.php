<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CadAdvertisementType;


class CadAdvertisementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $types = [
            [
                'advertisement_type_name' => 'Image',
                'advertisment_type_id' => 1,
                'is_active' => 1,
            ],
            [
                'advertisement_type_name' => 'Video',
                'advertisment_type_id' => 2,
                'is_active' => 1,
            ]
        ];

        foreach ($types as $key => $value) {
            CadAdvertisementType::updateOrCreate($value);
        }
    }
}
