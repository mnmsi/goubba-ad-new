<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement_categories', function (Blueprint $table) {
            $table->id();
            $table->string('advertisement_categories_name');
            $table->unsignedBigInteger('advertisement_category_id')->index();
            $table->unsignedBigInteger('is_active');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisement_categories');
    }
}
