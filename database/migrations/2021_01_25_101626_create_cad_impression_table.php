<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadImpressionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_impression', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advertisement_id');
            $table->unsignedBigInteger('daily_impression');
            $table->unsignedBigInteger('lifetime_impression');
            $table->timestamps();
            $table->softDeletes();

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
        Schema::dropIfExists('cad_impression');
    }
}
