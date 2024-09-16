<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('bodywork')->nullable();
            $table->string('power')->nullable();
            $table->string('cylinder')->nullable();
            $table->string('weight')->nullable();
            $table->string('license_plate')->nullable();
            $table->string('quilometers')->nullable();
            $table->string('colour')->nullable();
            $table->string('vat_margin')->nullable();
            $table->string('average_consumption')->nullable();
            $table->string('consumption_city')->nullable();
            $table->string('highway_consumption')->nullable();
            $table->string('co_2_emissions')->nullable();
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
