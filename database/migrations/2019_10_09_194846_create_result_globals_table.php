<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResultGlobalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_globals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_indicator')->unsigned();
            $table->foreign('id_indicator')->references('id')->on('indicators')->onDelete('cascade');
            $table->decimal('ensemble',6,2);
            $table->decimal('urbain',6,2);
            $table->decimal('rural',6,2);
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
        Schema::dropIfExists('result_globals');
    }
}
