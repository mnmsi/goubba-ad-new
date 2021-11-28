<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
//         \App\Models\CadUser::factory(10)->create();
        $this->call([
            CadUserRoleSeeder::class,
            UserSeeder::class,
            CadAdvertisementCategoriesSeeder::class,
            CadAdvertisementTypeSeeder::class,
        ]);

        Schema::enableForeignKeyConstraints();
    }
}
