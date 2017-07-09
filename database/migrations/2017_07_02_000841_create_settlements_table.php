<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettlementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settlements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('settlement_type_id')->unsigned();
            $table->integer('zip_code_id')->unsigned();
            $table->integer('key')->unsigned();
            $table->string('name');
            $table->string('zone_type')->nullable();
            $table->timestamps();

            $table->foreign('settlement_type_id')->references('id')->on('settlement_types');
            $table->foreign('zip_code_id')->references('id')->on('zip_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
}
