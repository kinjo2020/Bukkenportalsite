<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukkensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bukkens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('estate_id');
            $table->string('kinds');
            $table->string('name');
            $table->string('address');
            $table->string('rent');
            $table->string('management_fee');
            $table->string('floor');
            $table->string('floor_plan');
            $table->string('nearest_station');
            $table->string('age');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('estate_id')->references('id')->on('estates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bukkens');
    }
}
