<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertismentCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisment_campaign', function (Blueprint $table) {
            $table->id();
            $table->string('campaign_name');
            $table->unsignedBigInteger('campaign_type_id');
            $table->timestamps();
            $table->softDeletes();

            // $table->foreign('camapign_type_id')
            //     ->references('campaign_type_id')
            //     ->on('cad_advertisement_campaign_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisment_campaign');
    }
}
