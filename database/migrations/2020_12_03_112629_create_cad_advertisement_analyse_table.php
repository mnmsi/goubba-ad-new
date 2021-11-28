<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementAnalyseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement_analyse', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('link_clicks');
            $table->integer('image_clicks');
            $table->time('watch_duration');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('advertisement_id')
                ->references('id')
                ->on('cad_advertisement');

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisement_analyse');
    }
}
