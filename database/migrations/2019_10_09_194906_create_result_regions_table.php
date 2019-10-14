<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_regions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_region')->unsigned();
            $table->foreign('id_region')->references('id')->on('regions')->onDelete('cascade');
            $table->integer('id_indicator')->unsigned();
            $table->foreign('id_indicator')->references('id')->on('indicators')->onDelete('cascade');
            $table->decimal('value',6,2);
             $table->string('year');
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
        Schema::dropIfExists('result_regions');
    }
}
