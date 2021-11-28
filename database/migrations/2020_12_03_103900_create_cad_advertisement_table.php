<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement', function (Blueprint $table) {
            $table->id();
            $table->string('brand_title');
            $table->string('brand_logo');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('campaign_id');
            $table->string('title');
            $table->text('desc');
            $table->unsignedBigInteger('adv_position')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedBigInteger('rewards_amount')->nullable();
            $table->unsignedBigInteger('budget');
            $table->string('is_active');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('advertisement_category_id')
                ->on('cad_advertisement_categories');

            $table->foreign('type_id')
                ->references('advertisment_type_id')
                ->on('cad_advertisement_type');

            $table->foreign('user_id')
                ->references('id')
                ->on('cad_users');

            $table->foreign('campaign_id')
                ->references('campaign_type_id')
                ->on('cad_advertisement_campaign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisement');
    }
}
