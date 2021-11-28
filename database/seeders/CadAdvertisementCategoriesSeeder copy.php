<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\CadAdvertisementCategories;


class CadAdvertisementCategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [
            [
                'advertisement_categories_name' => 'Feed',
                'advertisement_category_id' => 1,
                'is_active' => 1,
            ],
            [
                'advertisement_categories_name' => 'Story',
                'advertisement_category_id' => 2,
                'is_active' => 1,
            ],
            [
                'advertisement_categories_name' => 'Banner',
                'advertisement_category_id' => 3,
                'is_active' => 1,
            ],
            [
                'advertisement_categories_name' => 'Reward',
                'advertisement_category_id' => 4,
                'is_active' => 1,
            ],
        ];

        foreach ($categories as $key => $value) {
            CadAdvertisementCategories::updateOrCreate($value);
        }
    }
}
