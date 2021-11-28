<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementVideoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement_video', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->string('video_link');
            $table->string('referal_link');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('advertisement_id')
            ->references('id')
            ->on('cad_advertisement');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cad_advertisement_video');
    }
}
