<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCadAdvertisementTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cad_advertisement_type', function (Blueprint $table) {
            $table->id();
            $table->string('advertisement_type_name');
            $table->unsignedBigInteger('advertisment_type_id')->index();
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
        Schema::dropIfExists('cad_advertisement_type');
    }
}
