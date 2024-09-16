<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('car_model_id')->nullable();
            $table->foreign('car_model_id', 'car_model_fk_10121684')->references('id')->on('car_models');
            $table->unsignedBigInteger('year_id')->nullable();
            $table->foreign('year_id', 'year_fk_10121690')->references('id')->on('years');
            $table->unsignedBigInteger('fuel_id')->nullable();
            $table->foreign('fuel_id', 'fuel_fk_10121685')->references('id')->on('fuels');
            $table->unsignedBigInteger('transmission_id')->nullable();
            $table->foreign('transmission_id', 'transmission_fk_10121686')->references('id')->on('transmissions');
        });
    }
}
