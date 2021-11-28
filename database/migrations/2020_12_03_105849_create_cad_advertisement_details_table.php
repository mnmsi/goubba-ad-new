<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->string('age_range');
            $table->text('country_id');
            $table->text('city_id');
            $table->text('state_id');
            $table->softDeletes();
            $table->timestamps();

            // $table->foreign('advertisement_id')
            //     ->references('id')
            //     ->on('cad_advertisement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisement_details');
    }
}
